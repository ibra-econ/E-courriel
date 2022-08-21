<?php

namespace App\Http\Controllers;

use App\Mail\Diffusion;
use App\Mail\Imputation as MailImputation;
use App\Models\Agenda;
use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Diffusion as ModelsDiffusion;
use App\Models\Imputation;
use App\Models\Journal;
use App\Models\User;
use App\Notifications\ImpuationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ImputationController extends Controller
{
    public function create(Request $request)
    {
        // add imputation
        $imputation = new Imputation();
        $imputation->courrier_id = $request->courrier;
        $imputation->departement_id = $request->departement;
        $imputation->user_id = Auth::user()->id;
        $imputation->delai = $request->delai;
        $imputation->observation = $request->observation;
        $imputation->save();

        // add courrier annotation dans la table pivot
        $courrier = Courrier::find($request->courrier);
        $courrier->annotations()->attach($request->annotation);

        // add diffusion pour avis
        if (!empty($request->diffusion)):
            foreach ($request->diffusion as $row):
                $diffusion = new ModelsDiffusion();
                $diffusion->courrier_id = $courrier->id;
                $diffusion->departement_id = $row;
                $diffusion->imputation_id = $imputation->id;
                $diffusion->user_id = Auth::user()->id;
                $diffusion->save();
            endforeach;
        endif;
        // add new agenda
        $agenda = new Agenda();
        $agenda->user_id = Auth::user()->id;
        $agenda->titre = 'Traitement du courrier N°' . $courrier->numero;
        $agenda->type = 0;
        $agenda->objet = 'Courrier a traiter avant la date';
        $agenda->debut = now();
        $agenda->fin = $request->delai;
        $agenda->heure_debut = date('h:i:s');
        $agenda->heure_fin = '00:00';
        $agenda->save();
        // add data dans la table pivot
        $agenda->users()->attach($request->diffusion);

        // update etat courrier
        $update = Courrier::where('id', $request->courrier)->update(['etat' => 'Imputer']);
        // get email chef de departement pour notification
        $user = User::where('departement_id', $request->departement)->where('role', 'admin')->orwhere('role', 'superuser')->first();
        // get email chef de departement en copie
        $user_diffusion = User::whereIn('departement_id', $request->diffusion)->where('role', 'superuser')->where('role', 'admin')->get();
        if ($request->notif === "OUI"):
            // envoie de email pour notifiaction
            Mail::to($user->email)->send(new MailImputation($courrier));

            foreach ($user_diffusion as $row):
                // Envoie de email
                Mail::to($row->email)->send(new Diffusion($courrier));
            endforeach;
            $user->notify(new ImpuationNotification($courrier));
            return back()->with('insert', 'imputation ajouter avec success et un email de notification a été envoyer');
        else:
            Notification::send($user_diffusion, new ImpuationNotification($courrier));
            return back()->with('insert', 'imputation ajouter avec success');
        endif;

        // add Journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = "Ajout de l'imputation du courrier N°" . $courrier->numero;
        $journal->save();
    }

    public function edit(Imputation $imputation)
    {

        // verification de l'autorisation
        if (!Gate::allows('update-imputation', $imputation)) {
            abort(403);
        }
        $item = Imputation::with('departement', 'courrier', 'diffusions')->find($imputation->id);
        $departement = Departement::all();
        $courrier = Courrier::with('annotations')->latest()->get();
        $annotation = Annotation::where('user_id', Auth::user()->id)->get();

        return view('imputation.update', compact(['item', 'departement', 'courrier', 'annotation']));
    }

    public function update(Request $request)
    {

        $imputation = Imputation::with('diffusions')->find($request->id);
        $imputation->courrier_id = $request->courrier;
        $imputation->departement_id = $request->departement;
        $imputation->save();

        // update courrier annotation dans la table pivot
        $courrier = Courrier::find($request->courrier);
        $courrier->annotations()->syncWithoutDetaching($request->annotations);

        $dd = ModelsDiffusion::where('imputation_id', $imputation->id)->truncate();
        // add diffusion pour avis
        if (!empty($request->diffusion)):
            foreach ($request->diffusion as $row):
                $diffusion = new ModelsDiffusion();
                $diffusion->courrier_id = $request->courrier;
                $diffusion->departement_id = $row;
                $diffusion->imputation_id = $imputation->id;
                $diffusion->user_id = Auth::user()->id;
                $diffusion->save();
            endforeach;
        endif;

        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Mise a jour de imputation N°' . $request->id;
        $journal->save();
        return back()->with('update', 'imputation mise à jour avec success');
    }

    // imputation show
    public function show(int $id)
    {
        $imputation = Imputation::with('courrier', 'departement', 'diffusions')->find($id);
        // update si le courrier a ete lu
        if (Auth::user()->departement_id == $imputation->departement_id):
            $etat = Imputation::whereId($imputation->id)->update(['etat' => 'lu']);
        endif;
        return view('imputation.show', compact(['imputation']));
    }

    // generate imputation fiche
    public function fiche(int $id)
    {
        $imputation = Imputation::with('courrier', 'departement')->find($id);
        return view('imputation.fiche', compact(['imputation']));
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Imputation::onlyTrashed()->get();
        return view('imputation.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id)
    {
        $delete = Imputation::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Imputation restaurer avec success";
        } else {
            $success = true;
            $message = "Imputation non trouver";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    // restaurer tous les elements
    public function restore_all()
    {
        $delete = Imputation::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les imputations ont été restaurés avec success";
        } else {
            $success = true;
            $message = "La corbeille a été vider";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function delete(int $id, Imputation $imputation)
    {
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression de imputation N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Imputation::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Imputation supprimer avec success";
        } else {
            $success = true;
            $message = "Imputation not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

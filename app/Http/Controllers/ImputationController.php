<?php

namespace App\Http\Controllers;

use App\Mail\Diffusion;
use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Imputation;
use App\Models\User;
use App\Notifications\ImpuationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ImputationController extends Controller
{
    public function create(Request $request)
    {
        // add imputation
        $imputation = new Imputation();
        $imputation->courrier_id = $request->courrier;
        $imputation->departement_id = $request->departement;
        $imputation->user_id = 1;
        $imputation->observation = $request->observation;
        $imputation->save();

        //    add annotation
        $courrier = Courrier::find($request->courrier);
        $courrier->annotations()->attach($request->annotation);
        // add diffusion pour avis
        $imputation->departements()->attach($request->diffusion);

        // $departement = Departement::whereIn('id',$request->diffusion)->get('code');


        if ($request->notif === "OUI"):
     // get email chef de departement
     $user = User::where([['departement_id', '=', $request->departement]])->first();
     // envoie de email pour notifiaction
     $user->notify(new ImpuationNotification($courrier));
            // get email chef de departement en copie
            $user_diffusion = User::whereIn('departement_id', $request->diffusion)->get('email');
            foreach ($user_diffusion as $row):
                Mail::to($row->email)->send(new Diffusion($courrier));
            endforeach;
            return back()->with('insert', 'imputation ajouter avec success et un email de notification a été envoyer');
        else:

            return back()->with('insert', 'imputation ajouter avec success');
        endif;

    }

    public function edit(int $id)
    {
        $imputation = Imputation::with('departements')->find($id);
        // dd($imputation);
        $departement = Departement::all();
        $courrier = Courrier::latest()->get();
        $annotation = Annotation::all();
        return view('imputation.update', compact(['imputation', 'departement', 'courrier', 'annotation']));
    }

    public function update(Request $request)
    {
        $imputation = Imputation::find($request->id);
        $imputation->courrier_id = $request->courrier;
        $imputation->departement_id = $request->departement;
        $imputation->date = $request->date;
        $imputation->save();
        return back()->with('update', 'imputation mise à jour avec success');
    }

    // imputation show
    public function show(int $id)
    {
        $imputation = Imputation::with('courrier', 'departements')->find($id);
        return view('imputation.show', compact(['imputation']));
    }

    // generate imputation fiche
    public function fiche(int $id)
    {
        $imputation = Imputation::with('courrier', 'departements')->find($id);
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

    public function delete(int $id)
    {
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

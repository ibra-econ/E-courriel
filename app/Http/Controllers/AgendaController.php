<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AgendaNotification;
use Illuminate\Support\Facades\Notification;

class AgendaController extends Controller
{
    public function create(Request $request)
    {

        // add agenda
        $agenda = new Agenda();
        $agenda->user_id = Auth::user()->id;
        $agenda->titre = $request->titre;
        $agenda->type = $request->type;
        $agenda->objet = $request->objet;
        $agenda->objet = $request->objet;
        $agenda->debut = $request->debut;
        $agenda->fin = $request->fin;
        $agenda->heure_debut = $request->heure_debut;
        $agenda->heure_fin = $request->heure_fin;
        $agenda->save();

        // add data dans la table pivot
        $agenda->users()->attach($request->destinateurs);

        $users = User::whereIn('id',$request->destinateurs)->get();
        Notification::send($users, new AgendaNotification($agenda));

        return back()->with('insert', 'agenda ajouter avec success');
    }

    public function edit(int $id)
    {
        $agenda = Agenda::find($id);
        return view('agenda.update', compact(["agenda"]));
    }

    public function update(Request $request)
    {

        $agenda = Agenda::find($request->id);
        $agenda->nom = $request->nom;
        $agenda->save();
        return back()->with('update', 'agenda mise à jour avec success');
    }


     // corbeille dashboard
     public function corbeille()
     {
         $rows = Agenda::onlyTrashed()->get();
         return view('agenda.corbeille', compact(['rows']));
     }

     // restaurer tous un element
     public function restore(int $id)
     {
         $delete = Agenda::where('id', $id)->restore();
         // check data restore or not
         if ($delete == 1) {
             $success = true;
             $message = "Agenda restaurer avec success";
         } else {
             $success = true;
             $message = "Agenda non trouver";
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
         $delete = Agenda::withTrashed()->restore();
         // check data restore or not
         if ($delete == 1) {
             $success = true;
             $message = "Tout les Agenda ont été restaurés avec success";
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

        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression de agenda N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Agenda::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Agenda supprimer avec success";
        } else {
            $success = true;
            $message = "Agenda not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

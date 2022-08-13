<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poste;
use App\Models\Journal;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosteController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'nom' => ['required'],
        ]);

        $Poste = new Poste();
        $Poste->nom = $request->nom;
        if(Auth::user()->role === 'admin'):
        $Poste->departement_id = $request->departement;
        endif;
        if(Auth::user()->role === 'superuser'):
            $Poste->departement_id = Auth::user()->departement_id;
        endif;
        $Poste->save();
        return back()->with('insert', 'Poste ajouter avec success');
    }

    public function edit(int $id)
    {
        $poste = Poste::find($id);
        $departement = Departement::all();

        return view('poste.update', compact(["poste",'departement']));
    }

    public function update(Request $request)
    {
        // $this->authorize('update', $poste);
        $poste = Poste::find($request->id);
        $poste->nom = $request->nom;
        $poste->departement_id = $request->departement;
        $poste->save();
        return back()->with('update', 'Poste mise à jour avec success');
    }


     // corbeille dashboard
     public function corbeille()
     {
         $rows = Poste::onlyTrashed()->get();
         return view('poste.corbeille', compact(['rows']));
     }

     // restaurer tous un element
     public function restore(int $id, Poste $poste)
     {
        //  $this->authorize('restore', $Poste);
         $delete = Poste::where('id', $id)->restore();
         // check data restore or not
         if ($delete == 1) {
             $success = true;
             $message = "poste restaurer avec success";
         } else {
             $success = true;
             $message = "poste non trouver";
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
         $delete = Poste::withTrashed()->restore();
         // check data restore or not
         if ($delete == 1) {
             $success = true;
             $message = "Tout les poste ont été restaurés avec success";
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

    public function delete(int $id, Poste $Poste)
    {
        // $this->authorize('delete', $Poste);
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression de la Poste N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Poste::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Poste supprimer avec success";
        } else {
            $success = true;
            $message = "Poste not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

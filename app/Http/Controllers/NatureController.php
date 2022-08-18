<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NatureController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'nom' => ['required'],
        ]);

        $nature = new Nature();
        $nature->nom = $request->nom;
        $nature->save();
        return back()->with('insert', 'nature ajouter avec success');
    }

    public function edit(int $id)
    {
        $nature = Nature::find($id);
        return view('nature.update', compact(["nature"]));
    }

    public function update(Request $request)
    {

        $nature = nature::find($request->id);
        $nature->nom = $request->nom;
        $nature->save();
        return back()->with('update', 'nature mise à jour avec success');
    }


     // corbeille dashboard
     public function corbeille()
     {
         $rows = Nature::onlyTrashed()->get();
         return view('nature.corbeille', compact(['rows']));
     }

     // restaurer tous un element
     public function restore(int $id)
     {
         $delete = Nature::where('id', $id)->restore();
         // check data restore or not
         if ($delete == 1) {
             $success = true;
             $message = "Nature restaurer avec success";
         } else {
             $success = true;
             $message = "Nature non trouver";
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
         $delete = Nature::withTrashed()->restore();
         // check data restore or not
         if ($delete == 1) {
             $success = true;
             $message = "Tout les nature ont été restaurés avec success";
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
        $journal->libelle = 'Suppression de la nature N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Nature::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "nature supprimer avec success";
        } else {
            $success = true;
            $message = "nature not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

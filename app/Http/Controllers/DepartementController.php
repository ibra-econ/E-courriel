<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartementController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
            'code' => ['required'],
        ]);
        $departement = new Departement();
        $departement->nom = $request->nom;
        $departement->code = $request->code;
        $departement->save();
        // add Journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Ajout nouveau departement';
        $journal->save();
        return back()->with('insert', 'departement ajouter avec success');
    }

    public function edit(int $id)
    {
        $departements = Departement::find($id);
        return view('departement.update', compact(["departements"]));
    }

    public function update(Request $request)
    {
        $departement = Departement::find($request->id);
        $departement->nom = $request->nom;
        $departement->code = $request->code;
        $departement->save();
        // add Journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Mise à jour departement N°' . $request->id;
        $journal->save();

        return back()->with('update', 'departement mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Departement::onlyTrashed()->get();
        return view('departement.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id)
    {

        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Restoration du departement N°' . $id;
        $journal->save();
        $delete = Departement::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Departement restaurer avec success";
        } else {
            $success = true;
            $message = "Departement non trouver";
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
        $delete = Departement::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les departements ont été restaurés avec success";
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
        $journal->libelle = 'Suppression du Departement N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Departement::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "departement supprimer avec success";
        } else {
            $success = true;
            $message = "departement not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

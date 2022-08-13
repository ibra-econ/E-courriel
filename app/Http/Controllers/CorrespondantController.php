<?php

namespace App\Http\Controllers;

use App\Models\Correspondant;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorrespondantController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'phone' => ['required'],
            'fonction' => ['required', 'string'],
        ]);
        $correspondant = new Correspondant;
        $correspondant->nom = $request->nom;
        $correspondant->prenom = $request->prenom;
        $correspondant->email = $request->email;
        $correspondant->phone = $request->phone;
        $correspondant->fonction = $request->fonction;
        $correspondant->type = $request->type;
        $correspondant->save();

        // add Journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Ajout nouveau correspondant';
        $journal->save();
        return back()->with('insert', 'Correspondant mise à jour avec success');
    }

    public function edit(int $id, Correspondant $correspondant)
    {
        $row = Correspondant::find($id);
        return view('correspondant.update', compact(['row']));
    }

    public function update(Request $request, Correspondant $correspondant)
    {
        $correspondant = Correspondant::find($request->id);
        $correspondant->nom = $request->nom;
        $correspondant->prenom = $request->prenom;
        $correspondant->email = $request->email;
        $correspondant->phone = $request->phone;
        $correspondant->fonction = $request->fonction;
        $correspondant->type = $request->type;
        $correspondant->save();
        // ajout journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Mise à jour du correspondant N°' . $request->id;
        $journal->save();
        return back()->with('update', 'Correspondant mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Correspondant::onlyTrashed()->get();
        return view('correspondant.corbeille', compact(['rows']));
    }

    // restaurer un element
    public function restore(int $id)
    {
        $delete = Correspondant::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Correspondant restaurer avec success";

            // ajout journal
            $journal = new Journal();
            $journal->user_id = Auth::user()->id;
            $journal->libelle = 'restauration du correspondant N°' . $id;
            $journal->save();
        } else {
            $success = true;
            $message = "Correspondant not found";
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
        $delete = Correspondant::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les correspondants restaurés avec success";

            // ajout journal
            $journal = new Journal();
            $journal->user_id = Auth::user()->id;
            $journal->libelle = 'restaurer tout les correspondant';
            $journal->save();
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

    // supprimer un elements
    public function delete(int $id)
    {
        // ajout journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression du correspondant N°' . $id;
        $journal->save();
        $delete = Correspondant::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Correspondant supprimer avec success";
        } else {
            $success = true;
            $message = "Correspondant not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

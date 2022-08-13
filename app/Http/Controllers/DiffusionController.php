<?php

namespace App\Http\Controllers;

use App\Models\Diffusion;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiffusionController extends Controller
{
    public function edit(int $id)
    {
        $diffusion = Diffusion::find($id);
        return view('diffusion.update', compact(["diffusion"]));
    }

    public function update(Request $request)
    {
        $diffusion = Diffusion::find($request->id);
        $diffusion->courrier_id = $request->courrier;
        $diffusion->departement_id = $request->departement;
        $diffusion->imputation_id = $request->imputation;
        $diffusion->save();
        // add Journal
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Mise à jour diffusion N°' . $request->id;
        $journal->save();

        return back()->with('update', 'diffusion mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Diffusion::onlyTrashed()->get();
        return view('departement.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id)
    {

        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Restoration de la diffusion N°' . $id;
        $journal->save();
        $delete = Diffusion::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Diffusion restaurer avec success";
        } else {
            $success = true;
            $message = "Diffusion non trouver";
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
        $delete = Diffusion::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les diffusion ont été restaurés avec success";
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
        $journal->libelle = 'Suppression du diffusion N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Diffusion::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Diffusion supprimer avec success";
        } else {
            $success = true;
            $message = "Diffusion not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

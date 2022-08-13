<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnotationController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
        ]);
        $annotation = new Annotation();
        $annotation->nom = $request->nom;
        $annotation->user_id = Auth::user()->id;
        $annotation->save();
        return back()->with('insert', 'annotation ajouter avec success');
    }

    public function edit(int $id, Annotation $annotation)
    {

        $annotation = Annotation::find($id);
        return view('annotation.update', compact(["annotation"]));
    }

    public function update(Request $request, Annotation $annotation)
    {
        $annotation = Annotation::find($request->id);
        $annotation->nom = $request->nom;
        $annotation->save();
        return back()->with('update', 'annotation mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Annotation::onlyTrashed()->get();
        return view('annotation.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id, Annotation $annotation)
    {
        $delete = Annotation::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Annotation restaurer avec success";
        } else {
            $success = true;
            $message = "Annotation non trouver";
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
        $delete = Annotation::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les annotations ont été restaurées avec success";
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

    // supprimer
    public function delete(int $id, Annotation $annotation)
    {
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression de annotation N°' . $id;
        $journal->save();
        // si oui supprimer de la BD
        $delete = Annotation::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "annotation supprimer avec success";
        } else {
            $success = true;
            $message = "annotation not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use Illuminate\Http\Request;

class AnnotationController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'nom' => ['required'],
        ]);

        $annotation = new Annotation();
        $annotation->nom = $request->nom;
        $annotation->save();
        return back()->with('insert', 'annotation ajouter avec success');
    }

    public function edit($id)
    {
        $annotation = Annotation::find($id);
        return view('update', compact(["annotation"]));
    }
    public function update(Request $request)
    {
        $annotation = Annotation::find($request->id);
        $annotation->nom = $request->nom;
        $annotation->save();
        return back()->with('update', 'annotation mise à jour avec success');
    }
    public function delete($id)
    {
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

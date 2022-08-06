<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    // voir le document fiche
    public function file_view(int $id)
    {
        $document = Document::find($id);
        $filePath = Storage::path($document->chemin);
        header('Content-Type: application/pdf');
        return response()->file($filePath);
    }

    public function update(Request $request)
    {

        // si le document existe
        // Storage::exists($link->document);
        // si oui supprimer le fichier
        // Storage::delete($link->document);
        if (!empty($request->file('document'))):

            $doc = Document::find($request->id);
            // renome le document
            $filename = 'C-' . $request->id . time() . '.' . $request->document->extension();
            // dd($filename);
            $chemin = $request->file('document')->storeAs('courrier/entrant', $filename, 'public');
            $doc->libelle = $request->libelle;
            $doc->chemin = $chemin;
            $doc->save();
        endif;
        return back()->with('update', 'Document mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Document::onlyTrashed()->get();
        return view('document.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id)
    {
        $delete = Document::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Document restaurer avec success";
        } else {
            $success = true;
            $message = "Document non trouver";
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
        $delete = Document::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les Document ont été restaurés avec success";
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
        $delete = Document::destroy($id);

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Document supprimer avec success";
        } else {
            $success = true;
            $message = "Document not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    public function update(Request $request)
    {

        if (!empty($request->file('document'))):

                $doc = Document::find($request->id);
                // renome le document
                $filename = 'C-' . $request->id . time() . '.' . $request->document->extension();
                // dd($filename);
                $chemin = $request->file('document')->storeAs('courrier/entrant', $filename, 'public');
                $doc->chemin = $chemin;
                $doc->save();
        endif;

        return back()->with('update', 'Document mise à jour avec success');
    }

    public function delete($id)
    {
        $link = Document::find($id);
        // si le document existe
        Storage::exists($link->document);
        // si oui supprimer le fichier
        Storage::delete($link->document);
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

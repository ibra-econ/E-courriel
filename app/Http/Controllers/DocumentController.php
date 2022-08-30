<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    public function edit(int $id)
    {
        // dd($id);
        $document = Document::find($id);
        return view('document.update', compact(['document']));
    }

    // voir le document et telecharger
    public function file_view(int $id)
    {
        $document = Document::find($id);
        $filePath = Storage::path($document->chemin);
        header('Content-Type: application/pdf');
        return response()->file($filePath);
    }

    public function update(Request $request)
    {

        $doc = Document::with('courrier')->find($request->id);
        $doc->libelle = $request->libelle;
        if (!empty($request->file('document'))):
            $dd = Storage::path($doc->chemin);
            Storage::exists($dd);
            // delete de l'image
            unlink($dd);
            // renome le document
            $filename = Str::random(10) . '.' . $request->document->extension();
            // si courrier entrant
            if ($doc->courrier->type === "arriver"):
                $chemin = $request->file('document')->storeAs('courrier/entrant', $filename, 'public');
            endif;
            // si courrier sortant
            if ($doc->courrier->type === "depart"):
                $chemin = $request->file('document')->storeAs('courrier/sortant', $filename, 'public');
                $doc->chemin = $chemin;
            endif;
            $doc->chemin = $chemin;
        endif;
        $doc->save();

        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'A mise à jour le document N°' . $request->id;
        $journal->save();
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
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Restoration du document N°' . $id;
        $journal->save();
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
        $journal = new Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression du document N°' . $id;
        $journal->save();
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

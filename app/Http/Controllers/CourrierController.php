<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\Document;
use App\Models\Nature;
use Illuminate\Http\Request;

class CourrierController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'type' => ['required'],
            'objet' => ['required'],
            'reference' => ['required'],
            'destinateur' => ['required'],
            'emetteur' => ['required', 'string'],
            'date_arriver' => ['required', 'string'],
            'etat' => ['required'],
        ]);

        $courrier = new Courrier();
        $courrier->type = $request->type;
        $courrier->user_id = 1;
        $courrier->nature_id = $request->nature;
        $courrier->reference = uniqid();
        $courrier->objet = $request->objet;
        $courrier->destinateur = $request->destinateur;
        $courrier->emetteur = $request->emetteur;
        $courrier->etat = $request->etat;
        $courrier->date_arriver = $request->date_arriver;
        $courrier->priorite = $request->priorite;
        $courrier->confidentiel = $request->confidentiel;
        $courrier->date = $request->date;
        $courrier->save();
        if (!empty($request->file('document'))):
            $last_id = Courrier::latest()->first();
            // add courrier scanner
            foreach ($request->document as $row):
                $doc = new Document();
                // renome le document
                $filename = 'C-' . $last_id->id . time() . '.' . $row->extension();
                // dd($filename);
                $chemin = $row->storeAs('courrier/entrant', $filename, 'public');
                $doc->chemin = $chemin;
                $doc->courrier_id = $last_id->id;
                $doc->save();
            endforeach;

        endif;

        return back()->with('insert', 'courrier ajouter avec success');
    }

    public function show($id)
    {
        $courrier = Courrier::with('documents', 'departements')->find($id);
        // dd($courrier);
        return view('courrier_show', compact(["courrier"]));
    }

    public function edit($id)
    {
        $courrier = Courrier::with('documents', 'nature')->find($id);
        $nature = Nature::all();
        return view('courrier_update', compact(["courrier", 'nature']));
    }

    public function update(Request $request)
    {
        $request->validate([
            'type' => ['required'],
            'objet' => ['required'],
            'destinateur' => ['required'],
            'emetteur' => ['required', 'string'],
            'date_arriver' => ['required', 'string'],
            'etat' => ['required'],
        ]);
        $courrier = Courrier::find($request->id);
        $courrier->type = $request->type;
        $courrier->objet = $request->objet;
        $courrier->nature_id = $request->nature;
        $courrier->destinateur = $request->destinateur;
        $courrier->emetteur = $request->emetteur;
        $courrier->etat = $request->etat;
        $courrier->date_arriver = $request->date_arriver;
        $courrier->priorite = $request->priorite;
        $courrier->confidentiel = $request->confidentiel;
        $courrier->date = $request->date;
        if (!empty($request->file('document'))):
            // add courrier scanner
            foreach ($request->document as $row):
                $doc = new Document();
                // renome le document
                $filename = 'C-' . $request->id . time() . '.' . $row->extension();
                // dd($filename);
                $chemin = $row->storeAs('courrier/entrant', $filename, 'public');
                $doc->chemin = $chemin;
                $doc->courrier_id = $request->id;
                $doc->save();
            endforeach;

        endif;

        $courrier->save();
        return back()->with('update', 'courrier mise à jour avec success');
    }
    public function delete($id)
    {
        $link = Courrier::find($id);

        // si oui supprimer de la BD
        $delete = Courrier::destroy($id);

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "courrier supprimer avec success";
        } else {
            $success = true;
            $message = "courrier not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

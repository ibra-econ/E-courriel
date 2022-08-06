<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Courrier;
use App\Models\Document;
use App\Models\Annotation;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Correspondant;

class CourrierController extends Controller
{

    public function create(Request $request)
    {
        // dd($request);
        $request->validate([
            'objet' => ['required'],
            'reference' => ['required'],
            'correspondant' => ['required'],
            'date_arriver' => ['required'],
        ]);

        $courrier = new Courrier();
        $courrier->type = $request->type;
        $courrier->user_id = 1;
        $courrier->nature_id = $request->nature;
        $courrier->correspondant_id = $request->correspondant;
        $courrier->reference = $request->reference;
        $courrier->objet = $request->objet;
        $courrier->etat = 'A traiter';
        $courrier->date_arriver = $request->date_arriver;
        $courrier->priorite = $request->priorite;
        $courrier->numero = $request->numero;
        $courrier->confidentiel = $request->confidentiel;
        $courrier->date = $request->date;
        $courrier->save();
        if (!empty($request->file('document'))):
            $last_id = Courrier::latest()->first();
            // add courrier scanner
            foreach ($request->document as $row):
                $doc = new Document();
                $i = 0;

                // renome le document
                $filename =  Str::random(10). '.' . $row->extension();
                // si courrier entrant
                if ($request->type === "arriver"):
                    $chemin = $row->storeAs('courrier/entrant', $filename, 'public');
                endif;
                // si courrier sortant
                if ($request->type === "depart"):
                    $chemin = $row->storeAs('courrier/sortant', $filename, 'public');
                endif;
                $doc->chemin = $chemin;
                $doc->libelle = $request->numero.'-document-'.$i+1;
                $doc->courrier_id = $last_id->id;
                $doc->save();
            endforeach;
        endif;

        return back()->with('insert', 'courrier ajouter avec success');
    }

    public function show(int $id)
    {
        $courrier = Courrier::with('documents', 'correspondant', 'annotations', 'imputation')->find($id);
        $annotation = Annotation::all();
        $departement = Departement::all();
        return view('courrier.show', compact(["courrier", 'annotation', 'departement']));
    }

    public function edit(int $id)
    {
        $courrier = Courrier::with('documents', 'nature')->find($id);
        $nature = Nature::all();
        $correspondant = Correspondant::all();
        return view('courrier.update', compact(["courrier", 'nature', 'correspondant']));
    }

    // generate circulation fiche
    public function fiche(int $id)
    {
        $courrier = Courrier::find($id);
        $annotation = Annotation::all('id', 'nom');
        $departement = Departement::all('id', 'code');
        return view('courrier.fiche', compact(['courrier', 'annotation', 'departement']));
    }


    public function update(Request $request)
    {
        $request->validate([
            'type' => ['required'],
            'objet' => ['required'],
            'correspondant' => ['required'],
            'date_arriver' => ['required', 'string'],
            'etat' => ['required'],
        ]);
        $courrier = Courrier::find($request->id);
        $courrier->type = $request->type;
        $courrier->objet = $request->objet;
        $courrier->nature_id = $request->nature;
        $courrier->correspondant_id = $request->correspondant;
        $courrier->etat = 'A Traiter';
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
                // si courrier entrant
                if ($request->type === "arrivée"):
                    $chemin = $row->storeAs('courrier/entrant', $filename, 'public');
                endif;
                // si courrier sortant
                if ($request->type === "départ"):
                    $chemin = $row->storeAs('courrier/sortant', $filename, 'public');
                endif;
                $doc->chemin = $chemin;
                $doc->courrier_id = $request->id;
                $doc->save();
            endforeach;

        endif;

        $courrier->save();
        return back()->with('update', 'courrier mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = Courrier::onlyTrashed()->get();
        return view('courrier.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id)
    {
        $delete = Courrier::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Courrier restaurer avec success";
        } else {
            $success = true;
            $message = "Courrier non trouver";
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
        $delete = Courrier::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les Courrier ont été restaurés avec success";
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

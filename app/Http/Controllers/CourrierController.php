<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\Nature;
use App\Models\Journal;
use App\Models\Courrier;
use App\Models\Document;
use App\Models\Annotation;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourrierController extends Controller
{

    public function create(Request $request)
    {

        $courrier = new Courrier();
        $courrier->type = $request->type;
        $courrier->user_id = 1;
        $courrier->nature_id = $request->nature;
        $courrier->correspondant_id = $request->correspondant;
        $courrier->reference = $request->reference;
        $courrier->objet = $request->objet;
        $courrier->etat = 'Enregistré';
        if($request->type !== "interne"):
        $courrier->date_arriver = $request->date_arriver;
        endif;
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
                 // si courrier interne
                 if ($request->type === "interne"):
                    $chemin = $row->storeAs('courrier/interne', $filename, 'public');
                endif;
                $doc->chemin = $chemin;
                $doc->libelle = 'document-1';
                $doc->courrier_id = $last_id->id;
                $doc->user_id = Auth::user()->id;
                $doc->save();
            endforeach;
        endif;
        // add Journal
        $journal = New Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Ajout du courrier N°'.$request->numero;
        $journal->save();

        return back()->with('insert', 'courrier ajouter avec success');
    }

    public function show(int $id)
    {
        $courrier = Courrier::with('documents', 'correspondant', 'annotations', 'imputation')->find($id);
        $annotation = Annotation::all();
        $departement = Departement::all();
        return view('courrier.show', compact(["courrier", 'annotation', 'departement']));
    }

    public function show_suivie(int $id)
    {
        $courrier = Courrier::with('documents', 'correspondant', 'annotations', 'imputation')->find($id);
        $annotation = Annotation::all();
        $departement = Departement::all();
        return view('courrier.suivie_show', compact(["courrier", 'annotation', 'departement']));
    }

    public function edit(int $id)
    {
        $courrier = Courrier::with('documents', 'nature','correspondant')->find($id);
        $nature = Nature::all();
        $correspondant = Correspondant::all();
        return view('courrier.update', compact(["courrier", 'nature', 'correspondant']));
    }

    // generate fiche de circulation du courrier
    public function fiche(int $id)
    {
        $courrier = Courrier::find($id);
        $annotation = Annotation::all('id', 'nom');
        $departement = Departement::all('id', 'code');
        return view('courrier.fiche', compact(['courrier', 'annotation', 'departement']));
    }


    public function update(Request $request ,Courrier $courrier)
    {
        $courrier = Courrier::find($request->id);
        $courrier->type = $request->type;
        $courrier->objet = $request->objet;
        $courrier->nature_id = $request->nature;
        $courrier->correspondant_id = $request->correspondant;
        if(Auth::user()->role === 'admin'):
        $courrier->etat = $request->etat;
        endif;
        $courrier->date_arriver = $request->date_arriver;
        $courrier->priorite = $request->priorite;
        $courrier->confidentiel = $request->confidentiel;
        $courrier->date = $request->date;
        if (!empty($request->file('document'))):
            $last_id = Courrier::latest()->first();
            // add courrier scanner
            foreach ($request->document as $row):
                $doc = new Document();

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
                $doc->libelle = 'document-1';
                $doc->courrier_id = $last_id->id;
                $doc->user_id = Auth::user()->id;
                $doc->save();
            endforeach;
        endif;
        $courrier->save();

         // add Journal
        $journal = New Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Mise à jour du courrier N°'.$courrier->numero;
        $journal->save();
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

        $link = Courrier::find($id);
        $journal = New Journal();
        $journal->user_id = Auth::user()->id;
        $journal->libelle = 'Suppression du courrier N°'.$link->numero;
        $journal->save();
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

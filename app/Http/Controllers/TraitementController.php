<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Imputation;
use Illuminate\Http\Request;

class TraitementController extends Controller
{
    // imputation show
    public function show(int $id)
    {
        $imputation = Imputation::with('courrier', 'departement', 'diffusions')->find($id);
        $annotation = Annotation::all();
        return view('traitement.update', compact(['imputation', 'annotation']));
    }

    public function save_traitement(Request $request)
    {
        // dd($request->valider);
        $courrier = Courrier::find($request->id);
        if ($request->archiver === "on" and $request->valider === "on"):
            $courrier->etat = "Archiver";
        endif;
        if ($request->archiver == null and $request->valider === "on"):
            $courrier->etat = "Traiter";
        endif;
        if ($request->archiver == null and $request->valider == null):
            $courrier->etat = "Imputer";
        endif;
        $courrier->save();
        return back()->with('update', 'Traitement effectuer avec success');
    }
}

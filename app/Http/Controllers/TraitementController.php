<?php

namespace App\Http\Controllers;

use App\Models\Courrier;

class TraitementController extends Controller
{

    public function edit($id)
    {
        $courrier = Courrier::find($id);
        return view('traitement_fiche', compact(["courrier"]));
    }
}

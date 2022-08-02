<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Nature;
use App\Models\User;

class RouteController extends Controller
{
    // Route dashboard function
    public function home()
    {
        $nature = Nature::all();
        $departement = Departement::all();
        // Total courrier arriver
        $arriver = Courrier::where('type', 'arrivée')->count();
        // Total courrier depart
        $depart = Courrier::where('type', 'depart')->count();
        // Total courrier utilisatiers
        $user = User::count();
        // courrier data
        $rows = Courrier::with('nature', 'user')->where('etat', '!=', 'Archiver')->paginate(10);
        return view('dashboard', compact(['rows', 'nature', 'departement', 'arriver', 'depart', 'user']));
    }
    // Route compte function
    public function compte()
    {
        $rows = User::latest()->get();
        return view('compte', compact(['rows']));
    }

    // Route departement function
    public function departement()
    {
        $user = User::all('id', 'name', 'poste');
        $rows = Departement::latest()->get();
        return view('departement', compact(['rows', 'user']));
    }

    // Route nature function
    public function nature()
    {
        return view('nature');
    }

    // Route Annotation function
    public function annotation()
    {
        $rows = Annotation::all();
        return view('annotation', compact(['rows']));
    }

    // Route Annotation function
    public function traitement()
    {
        $rows = Courrier::where('etat', 'A Traiter')->latest()->get();
        return view('traitement', compact(['rows']));
    }

    // Route imputation function
    public function imputation()
    {
        $rows = Courrier::where('etat', 'A Traiter')->latest()->get();
        $departement = Departement::all();
        $annotation = Annotation::all();
        return view('imputation', compact(['rows', 'departement', 'annotation']));
    }

    // Route archive_courrier function
    public function archive_courrier()
    {
        $rows = Courrier::where('etat', "Archiver")->get();
        return view('archive.courrier', compact(['rows']));
    }

    // Route archive_courrier function
    public function archive_document()
    {
        $rows = Document::with('courrier')->get();
        return view('archive.document', compact(['rows']));
    }
}

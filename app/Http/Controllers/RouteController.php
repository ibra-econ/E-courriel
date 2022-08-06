<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use App\Models\Config;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Imputation;
use App\Models\Journal;
use App\Models\Nature;
use App\Models\User;

class RouteController extends Controller
{
    // Route dashboard function
    public function dashboard()
    {
        // Total Correspondant
        $correspondant = Correspondant::count();
        // Total courrier arriver
        $arriver = Courrier::where('type', 'arriver')->count();
        // Total courrier depart
        $depart = Courrier::where('type', 'depart')->count();
        // Total utilisatiers
        $user = User::count();
        // Total departement
        $departement = Departement::count();
        return view('dashboard', compact(['correspondant', 'arriver', 'depart', 'user', 'departement']));
    }

    // Route depart function
    public function depart()
    {
        $nature = Nature::all();

        $correspondant = Correspondant::all('id', 'fonction', 'nom', 'prenom');

        $corbeille = Courrier::onlyTrashed()->count();

        $rows = Courrier::withTrashed()->with('nature', 'user', 'correspondant')->where('type', 'depart')->where('etat', '!=', 'Archiver')->latest()->get();

        return view('courrier.depart', compact(['rows', 'correspondant', 'nature', 'corbeille']));
    }

    // Route arriver function
    public function arriver()
    {
        $nature = Nature::all();

        $correspondant = Correspondant::all();

        $corbeille = Courrier::onlyTrashed()->count();

        $rows = Courrier::with('nature', 'user', 'correspondant')->where('type', 'arriver')->where('etat', '!=', 'Archiver')->latest()->get();

        return view('courrier.arriver', compact(['rows', 'correspondant', 'nature', 'corbeille']));
    }

    // Route compte function
    public function compte()
    {
        $rows = User::with('departement', 'poste')->latest()->get();

        $corbeille = User::onlyTrashed()->count();

        return view('user.compte', compact(['rows', 'corbeille']));
    }

    // Route config function
    public function config()
    {
        // Total Correspondant
        $correspondant = Correspondant::count();
        // Total courrier
        $courrier = Courrier::count();
        // Total courrier archiver
        $archiver = Courrier::where('etat', 'Archiver')->count();
        // Total utilisatiers
        $user = User::count();
        // Total departement
        $departement = Departement::count();
        $rows = Config::first();
        return view('config', compact(['rows', 'courrier', 'correspondant', 'archiver', 'user', 'departement']));
    }

    // Route departement function
    public function departement()
    {
        $rows = Departement::with('users', 'imputations')->latest()->get();

        $corbeille = Departement::onlyTrashed()->count();

        return view('departement.departement', compact(['rows', 'corbeille']));
    }

    // Route departement function
    public function correspondant()
    {
        $rows = Correspondant::all();

        $corbeille = Correspondant::onlyTrashed()->count();

        return view('correspondant.correspondant', compact(['rows', 'corbeille']));
    }

    // Route nature function
    public function nature()
    {
        $rows = Nature::all();
        return view('nature.nature', compact(['rows']));
    }

    // Route Annotation function
    public function annotation()
    {
        $rows = Annotation::all();

        $corbeille = Annotation::onlyTrashed()->count();

        return view('annotation.annotation', compact(['rows', 'corbeille']));
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
        $rows = Imputation::with('departements', 'user', 'courrier')->latest()->get();

        $corbeille = Imputation::onlyTrashed()->count();

        $departement = Departement::all();

        $courrier = Courrier::latest()->get();

        $annotation = Annotation::all();
        return view('imputation.imputation', compact(['rows', 'corbeille', 'courrier', 'departement', 'annotation']));
    }

    // Route archive_courrier function
    public function archive_courrier()
    {
        $rows = Courrier::where('etat', "Archiver")->get();

        $corbeille = Courrier::onlyTrashed()->count();

        return view('archive.courrier', compact(['rows', 'corbeille']));
    }

    // Route archive_courrier function
    public function document()
    {
        $rows = Document::with('courrier')->latest()->get();
        // dd($rows);
        $corbeille = Document::onlyTrashed()->count();

        return view('document.document', compact(['rows', 'corbeille']));
    }

    // Route journal function
    public function journal()
    {
        $rows = Journal::with('user')->get();

        $corbeille = Journal::onlyTrashed()->count();
        return view('journal.journal', compact(['rows', 'corbeille']));
    }
}

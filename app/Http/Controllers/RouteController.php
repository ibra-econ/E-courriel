<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Config;
use App\Models\Nature;
use App\Models\Journal;
use App\Models\Courrier;
use App\Models\Document;
use App\Models\Diffusion;
use App\Models\Annotation;
use App\Models\Imputation;
use App\Models\Departement;
use App\Models\Correspondant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    // Route dashboard function
    public function dashboard()
    {
        // si pas admin
        if (Auth::user()->role !== "admin"):
            // Total courrier arriver
            $arriver = Courrier::where([['type', '=', 'arriver'], ['user_id', '=', Auth::user()->id]])->count();
            // Total courrier depart
            $depart = Courrier::where([['type', '=', 'depart'], ['user_id', '=', Auth::user()->id]])->count();
            $tes = Courrier::orderBy('created_at')->get();

        endif;

        // si admin
        // Total Correspondant
        $correspondant = Correspondant::count();
        // Total courrier arriver
        $arriver = Courrier::where('type', 'arriver')->count();
        // Total courrier depart
        $depart = Courrier::where('type', 'depart')->count();
        // Total courrier interne
        $interne = Courrier::where('type', 'interne')->count();
        // Total utilisatiers
        $user = User::count();
        // Total departement
        $departement = Departement::count();

        // courrier arriver chart
        $courrier_arriver = Courrier::select(DB::raw("COUNT(*) as count"), DB::raw("created_at as month_name"))
        ->where('type','arriver')
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("created_at"))
        ->pluck('count', 'month_name');

        $label_arriver = $courrier_arriver->keys();
        $data_arriver = $courrier_arriver->values();

                // courrier depart chart
                $courrier_depart = Courrier::select(DB::raw("COUNT(*) as count"), DB::raw("created_at as month_name"))
                ->where('type','depart')
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("created_at"))
                ->pluck('count', 'month_name');

                $label_depart = $courrier_depart->keys();
                $data_depart = $courrier_depart->values();

        return view('dashboard', compact(['correspondant', 'arriver', 'depart', 'user', 'departement', 'interne','label_arriver', 'data_arriver','label_depart','data_depart']));
    }

    // Route courrier depart function
    public function depart()
    {
        // si pas admin
        if (Auth::user()->role !== "admin"):
            // get courrier depart
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'depart')
                ->where('user_id', Auth::user()->id)
                ->where('etat', 'Enregistr??')->latest()->get();
        else:
            $rows = Courrier::withTrashed()->with('nature', 'user', 'correspondant')
                ->where('type', 'depart')
                ->where('etat', 'Enregistr??')->latest()->get();
        endif;

        // get tous les correspondant courrier
        $correspondant = Correspondant::where('type', 'externe')->get();

        // get courrier corbeille courrier
        $corbeille = Courrier::onlyTrashed()->count();

        // get tous les nature courrier
        $nature = Nature::all();

        // get le derinier numero du courrier depart
        $numero = Courrier::where('type', 'depart')->latest()->first('numero');

        return view('courrier.depart', compact(['rows', 'correspondant', 'nature', 'corbeille', 'numero']));
    }

    // Route courrier arriver function
    public function arriver()
    {
        // si pas admin
        if (Auth::user()->role !== "admin"):
            // Total courrier arriver
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'arriver')
                ->where('user_id', Auth::user()->id)
                ->where('etat', 'Enregistr??')->latest()->get();

        else:
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'arriver')
                ->where('etat', 'Enregistr??')->latest()->get();
            // dd($rows);
        endif;
        // get tous les correspondant courrier
        $correspondant = Correspondant::where('type', 'externe')->get();

        // get courrier corbeille courrier
        $corbeille = Courrier::onlyTrashed()->count();

        // get tous les nature courrier
        $nature = Nature::all();

        // get le derinier numero du courrier arriver
        $numero = Courrier::where('type', 'arriver')->latest()->first('numero');
        // dd($numero);
        return view('courrier.arriver', compact(['rows', 'correspondant', 'nature', 'corbeille', 'numero']));
    }

    // Route courrier interne function
    public function interne()
    {
        // si pas admin
        if (Auth::user()->role !== "admin"):
            // Total courrier arriver
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'interne')
                ->where('user_id', Auth::user()->id)
                ->where('etat', 'Enregistr??')->latest()->get();

        else:
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'interne')
                ->where('etat', 'Enregistr??')->latest()->get();

        endif;
        // get tous les correspondant courrier
        $correspondant = Correspondant::where('type', 'interne')->get();

        // get courrier corbeille courrier
        $corbeille = Courrier::onlyTrashed()->count();

        // get tous les nature courrier
        $nature = Nature::all();

        // get le derinier numero du courrier arriver
        $numero = Courrier::where('type', 'interne')->latest()->first('numero');
        // dd($numero);
        return view('courrier.interne', compact(['rows', 'correspondant', 'nature', 'corbeille', 'numero']));
    }

    // Route suivie courrier arriver function
    public function suivie()
    {
        // si pas admin
        if (Auth::user()->role !== "admin"):
            // Total courrier arriver
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'arriver')
                ->where('user_id', Auth::user()->id)
                ->where('etat', 'Enregistr??')->latest()->get();

        else:
            $rows = Courrier::with('nature', 'user', 'correspondant')
                ->where('type', 'arriver')
                ->where('etat', 'Enregistr??')->latest()->get();
        endif;

        return view('courrier.suivie', compact(['rows']));
    }

    // Route compte function
    public function compte()
    {
        // si pas admin
        if (Auth::user()->role === "superuser"):
            $rows = User::with('departement')->where('departement_id', Auth::user()->departement_id)->latest()->get();
            $departement = Departement::where('id', Auth::user()->departement_id);
        endif;

        if (Auth::user()->role === "admin"):
            $rows = User::with('departement')->latest()->get();
            $departement = Departement::all();
        endif;
        $corbeille = User::onlyTrashed()->count();
        return view('user.compte', compact(['rows', 'departement', 'corbeille']));
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
        $rows = Departement::with('users', 'imputation')->latest()->get();

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
        $corbeille = Nature::onlyTrashed()->count();
        return view('nature.nature', compact(['rows', 'corbeille']));
    }

    // Route Annotation function
    public function annotation()
    {
        if (Auth::user()->role === "superuser"):
            $rows = Annotation::with('user')->where('user_id', Auth::user()->id)->get();
        endif;
        if (Auth::user()->role === "admin"):
            $rows = Annotation::with('user')->get();
        endif;
        $corbeille = Annotation::onlyTrashed()->count();
        return view('annotation.annotation', compact(['rows', 'corbeille']));
    }

    // Route imputation function
    public function imputation()
    {
        if (Auth::user()->role === "admin"):
            $rows = Imputation::with('departement', 'user', 'courrier')->latest()->get();
        endif;

        if (Auth::user()->role === "superuser"):
            $rows = Imputation::with('departement', 'user', 'courrier')
                ->where('user_id', Auth::user()->id)
                ->latest()->get();
        endif;

        if (Auth::user()->role === "secretaire"):
            $rows = Imputation::with('departement', 'user', 'courrier')
                ->where('departement_id', Auth::user()->departement_id)
                ->latest()->get();

        endif;

        // get imputation corbeille
        $corbeille = Imputation::onlyTrashed()->count();

        // get departemnt
        $departement = Departement::all();
        // get courrier
        $courrier = Courrier::where('type', 'arriver')->where('etat', 'Enregistr??')->latest()->get();
        // get annotation
        $annotation = Annotation::where('user_id', Auth::user()->id)->get();
        return view('imputation.imputation', compact(['rows', 'corbeille', 'courrier', 'departement', 'annotation']));
    }

    // Route traitement function
    public function traitement()
    {
        if (Auth::user()->role === "admin"):
            $rows = Imputation::with('departement', 'user', 'courrier')->where('etat','lu')->orwhere('etat','non lu')->latest()->get();
        endif;

        if (Auth::user()->role === "superuser"):
            $rows = Imputation::with('departement', 'user', 'courrier')
                ->where('user_id', Auth::user()->id)->where('etat','lu')->orwhere('etat','non lu')
                ->latest()->get();
        endif;

        if (Auth::user()->role === "secretaire"):
            $rows = Imputation::with('departement', 'user', 'courrier')
                ->where('departement_id', Auth::user()->departement_id)->where('etat','lu')->orwhere('etat','non lu')
                ->latest()->get();
        endif;
        return view('traitement.traitement', compact(['rows']));
    }

    // Route imputation function
    public function diffusion()
    {
        if (Auth::user()->role === "admin"):
            $rows = Diffusion::with('departement', 'imputation', 'courrier')->latest()->get();

        endif;

        if (Auth::user()->role === "superuser"):
            $rows = Diffusion::with('departement', 'imputation', 'courrier')
                ->where('departement_id', Auth::user()->departement_id)
                ->orwhere('user_id', Auth::user()->id)
                ->latest()->get();
        endif;
        // get imputation corbeille
        $corbeille = Diffusion::onlyTrashed()->count();
        return view('diffusion.diffusion', compact(['rows', 'corbeille']));
    }

    // Route archive_courrier function
    public function archive()
    {
        $rows = Courrier::where('etat', "Archiver")->get();
        $corbeille = Courrier::onlyTrashed()->count();
        return view('archive.archive', compact(['rows', 'corbeille']));
    }

    // Route archive_courrier function
    public function document()
    {
        if (Auth::user()->role === 'admin'):
            $rows = Document::with('courrier')->latest()->get();
        endif;

        if (Auth::user()->role === 'agent' || 'secretaire'):
            $rows = Document::with('courrier')
                ->where('user_id', Auth::user()->id)
                ->latest()->get();
        endif;
        $corbeille = Document::onlyTrashed()->count();
        return view('document.document', compact(['rows', 'corbeille']));
    }

    // Route journal function
    public function journal()
    {
        if (Auth::user()->role === 'admin'):
        $rows = Journal::with('user')->latest()->get();
        endif;
        $corbeille = Journal::onlyTrashed()->count();
        return view('journal.journal', compact(['rows', 'corbeille']));
    }

    // Route agenda function
    public function agenda()
    {
        if (Auth::user()->role !== 'admin'):
        $rows = Agenda::with('users')->where('user_id',Auth::user()->id)->latest()->get();
        else:
            $rows = Agenda::with('users')->latest()->get();
        endif;
        $user = User::with('departement')->get();
        $corbeille = Agenda::onlyTrashed()->count();
        return view('agenda.agenda', compact(['rows', 'corbeille', 'user']));
    }

}

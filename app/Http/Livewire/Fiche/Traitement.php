<?php

namespace App\Http\Livewire\Fiche;

use Livewire\Component;
use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Departement;

class Traitement extends Component
{
    public $annotation = [];
    public $imputation = [];

    public function save_annotation(){

        $courrier = Courrier::with('departements')->find(1);
       foreach($courrier->departements as $row):
        if($row->pivot->departement_id = 1):
            $courrier->departements()->attach($this->imputation);
            $courrier->save();
        endif;
        endforeach;

        // if():
        $courrier->departements()->attach($this->imputation);
        $courrier->save();
        // endif;

        // $courrier->departements()->attach([$this->annotation]);
        // $courrier->save();

       $this->dispatchBrowserEvent('alert', [
        'type' => 'success',
        'message' => "Traitement effectuer avec success!",

    ]);

    }

    public function save_imputation(){
        $this->dispatchBrowserEvent('show-form');
    }


    public function render()
    {
        $traitement = Annotation::all();
        $imputations = Departement::all();
        $courrier = Courrier::find(1);
        // dd($imputation);
        return view('livewire.fiche.traitement', compact(['courrier','imputations','traitement']));
    }
}

<?php

namespace App\Http\Livewire\Table;

use App\Models\Nature;
use Livewire\Component;

class NatureTable extends Component
{
    public $nom=[];

    public function edit($nature){
        $row = Nature::find($nature);
        $this->nom = $row;
        // dd($this->nom);
        $this->dispatchBrowserEvent('show-form');
        // return $row;
    }
    public function render()
    {
        $rows = Nature::all();
        return view('livewire.table.nature-table', compact(['rows']));
    }
}

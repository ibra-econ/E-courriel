<?php

namespace App\Http\Livewire\Table;

use App\Models\Annotation;
use Livewire\Component;

class AnnotationTable extends Component
{
    public function render()
    {
        $rows = Annotation::all();
        return view('livewire.table.annotation-table', compact(['rows']));
    }
}

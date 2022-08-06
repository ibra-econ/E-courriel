@extends('layouts.app')
@section('content')
<button type="button" id="print" onclick="imprimer()" class="btn btn-green-1">Imprimer</button>
<div class="row">
<div class="col-12">
    <div class="file-container border-top" id="document">
        <div class="file-panel mt-4">
            <div class="row my-4">

                @forelse ($courrier->documents as $row)

                <div class="col-md-3">
                    <div class="card shadow text-center mb-2">
                        <div class="card-body file">
                            <div class="file-action">
                                <a target="_blank" href="{{ route('show.document',['id'=> $row->id]) }}" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                <a href="{{ route('edit.document',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                            </div>
                            <div class="circle circle-lg bg-secondary my-4">
                                <span class="fe fe-folder fe-24 text-white"></span>
                            </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                            <strong>{{ $row->libelle }}</strong><br>
                            <strong>{{ $row->created_at->format('d/m/Y') }}</strong>
                        </div> <!-- .card-footer -->
                    </div> <!-- .card -->

                </div> <!-- .col -->
                @empty
                <div class="col-12 text-center">
                    <h2>Aucun document</h2>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12 my-4">
        <div class="shadow card">
            <div class="p-5 card-body">
                <div class="mb-5 row">
                    <div class="mb-4 text-center col-12">
                        <h3 class="mb-0 text-uppercase">
                            FICHE DE CIRCULATION COURRIER ARRIVEE N° {{ $courrier->id.' du
                            '.$courrier->created_at->format('d/m/Y') }}</h3>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2 text-dark text-uppercase font-weight-bolder">Numéro d’arrivée: N°{{
                            $courrier->numero }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Références: {{ $courrier->reference
                            }}
                        </p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Origine: {{
                            $courrier->correspondant->prenom.' '. $courrier->correspondant->nom }}
                        </p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Objet: {{ $courrier->objet }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-2 text-dark text-uppercase font-weight-bolder">Date d'arrivée : {{
                            date('d/m/Y',strtotime($courrier->date_arriver)) }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">En date du: {{
                            date('d/m/Y',strtotime($courrier->date)) }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Type: {{ $courrier->type }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Departement/Service:

                        </p>
                    </div>
                    <div class="my-4 text-center col-12">
                        <h3 class="mb-0 text-uppercase">Annotations</h3>
                    </div>
                    <div class="row">
                        @foreach ($annotation as $row)
                        @foreach($courrier->annotations as $row2)
                        @if ($row->id == $row2->pivot->annotation_id)
                        <div class="col-md-3">
                            <i class="fe fe-check fe-16 font-bold"></i> {{ $row->nom }}
                        </div>
                        @endif
                        @endforeach
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" disabled class="custom-control-input" value="{{ $row->id }}"
                                    id="{{ $row->id }}">
                                <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-4 text-center col-12">
                        <h3 class="mb-0 text-uppercase">Imputations</h3>
                    </div>
                    <div class="row">

                        @foreach ($departement as $row)
                        @isset($courrier->imputation)
                        @if($courrier->imputation->departement_id == $row->id)
                        <div class="col-md-3">
                            <i class="fe fe-check fe-16 font-bold"></i> {{ $row->nom }}
                        </div>
                        @endif
                        @endisset
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" disabled class="custom-control-input" value="{{ $row->id }}"
                                    id="{{ $row->id }}">
                                <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="ml-2 mt-2">
                        <p class="text-dark">Autres Précisions:</p>
                        <p class="text-dark">AUTRES ANNOTATIONS:</p>
                    </div>
                </div>
                <p class="text-center">NB : Tout courrier reçu doit faire l’objet d’une ventilation dans les 24 heures
                    qui suivent son arrivée.</p>

                <!-- /.row -->

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->


    </div>
</div>
<script>
    function imprimer()
{
    const btn = document.getElementById('print');
    // const document = document.getElementById('document').innerHTML;
    btn.style.display = 'none';
    // document.style.display = 'none';
    window.print();
    btn.style.display = 'block';
    // document.style.display = 'block';
}
</script>
@endsection

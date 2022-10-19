@extends('layouts.app')
@section('content')

<h2 class="col-12 text-center">Evolution du courrier N° {{ $imputation->courrier->numero }} </h2>
<div class="">
    @if (Session::has('update'))
    <div class="text-center alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ Session::get('update') }}</strong>
    </div>
    @endif
</div>
<div class="stepper-wrapper pt-3">
    <div class="stepper-item {{ $imputation->courrier->etat === "Enregistré" || "Imputer" ? 'completed' : '' }}">
      <div class="step-counter">
        <i class="fe fe-check"></i>
      </div>
      <div class="step-name">
       {{ $imputation->courrier->created_at->format('d/m/Y') }}
    </div>
    <div class="step-name">
        Enregistrer
    </div>
    </div>
    <div class="stepper-item {{ $imputation->courrier->etat === "Imputer" ? 'completed' : '' }} {{ $imputation->courrier->etat === "Traiter" || "Archiver" ? 'completed' : '' }}">
      <div class="step-counter">
        <i class="fe fe-check"></i>
      </div>
      <div class="step-name">
        {{ $imputation->created_at->format('d/m/Y') }}
     </div>
      <div class="step-name">Imputer</div>
    </div>
    <div class="stepper-item {{ $imputation->courrier->etat === "Traiter" ? 'completed' : '' }} {{ $imputation->courrier->etat === "Archiver" ? 'completed' : '' }}">
      <div class="step-counter">
        <i class="fe fe-check"></i>
      </div>
      <div class="step-name">
        {{ $imputation->fin_traitement !== null ? date('d/m/Y',strtotime($imputation->fin_traitement)) : '' }}
     </div>
      <div class="step-name">Valider</div>
    </div>
    <div class="stepper-item  {{ $imputation->courrier->etat === "Archiver" ? 'completed' : '' }}">
      <div class="step-counter">
        <i class="fe fe-check"></i>
    </div>
      <div class="step-name">Archiver</div>
    </div>
  </div>

<div class="row">
    {{-- courrier document --}}
    <div class="col-md-12 mb-4">
        <div class="accordion w-100" id="accordion1">
            <div class="card shadow">
                <div class="card-header" id="heading1">
                    <a role="button" href="#collapse1" data-toggle="collapse" data-target="#collapse1"
                        aria-expanded="false" aria-controls="collapse1">
                        <strong>Voir les documents</strong>
                    </a>
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion1">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="file-container border-top" id="document">
                                <div class="file-panel mt-4">
                                    <div class="row my-4">
                                        @forelse ($imputation->courrier->documents as $row)
                                        <div class="col-md-3">
                                            <div class="card text-center mb-2 shadow">
                                                <div class="card-body file">
                                                    <div class="file-action">
                                                        <a target="_blank"
                                                            href="{{ route('show.document',['id'=> $row->id]) }}"
                                                            role="button" class="btn btn-sm btn-green-1"><i
                                                                class="fe fe-eye"></i></a>
                                                        <a href="{{ route('edit.docu',['id'=> $row->id]) }}"
                                                            role="button" class="btn btn-sm btn-green-1"><i
                                                                class="fe fe-edit"></i></a>
                                                    </div>
                                                    <div class="circle circle-lg bg-light my-4">
                                                        <span class="fe fe-file fe-24 text-success"></span>
                                                    </div>
                                                    <div class="file-info">
                                                        <span class="badge badge-pill badge-light text-muted">PDF</span>
                                                    </div>
                                                </div> <!-- .card-body -->
                                                <div class="card-footer bg-transparent border-0 fname">
                                                    <strong>{{ $row->libelle }}</strong> <br>
                                                    <strong>crée: {{ date('d/m/Y',strtotime($row->created_at)) }}</strong>
                                                </div> <!-- .card-footer -->
                                            </div> <!-- .card -->
                                        </div>
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
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header" id="heading1">
                    <a role="button" href="#collapse2" data-toggle="collapse" data-target="#collapse2"
                        aria-expanded="false" aria-controls="collapse2">
                        <strong>Fiche de circulation du courrier</strong>
                    </a>
                </div>
                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" onClick="circulation('circulation')"
                                class="mb-2 btn btn-success">Imprimer</button>
                                <div class="p-5" id="circulation">
                                    <div class="mb-5 row">
                                        <div class="mb-4 text-center col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="avatar-lg">
                                                        <img src="{{ asset('assets/images/favicon.png') }}"
                                                            class="rounded mr-5" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <p> Morar-Bechtelar</p>
                                                    <p>johnston.claudia@example.net</p>
                                                    <p>Contact: +17475384534</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <h3 class="mb-0 text-uppercase">
                                                FICHE DE CIRCULATION COURRIER ARRIVEE N° {{ $imputation->courrier->id.'
                                                du
                                                '.$imputation->courrier->created_at->format('d/m/Y') }}</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2 text-dark text-uppercase font-weight-bolder">Numéro
                                                d’arrivée: N°{{
                                                $imputation->courrier->numero }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Références: {{
                                                $imputation->courrier->reference
                                                }}
                                            </p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Origine: {{
                                                $imputation->courrier->correspondant->prenom.' '.
                                                $imputation->courrier->correspondant->nom }}
                                            </p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Objet: {{
                                                $imputation->courrier->objet }}</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="mb-2 text-dark text-uppercase font-weight-bolder">Date d'arrivée :
                                                {{
                                                date('d/m/Y',strtotime($imputation->courrier->date_arriver)) }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">En date du: {{
                                                date('d/m/Y',strtotime($imputation->courrier->date)) }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Type: {{
                                                $imputation->courrier->type }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">
                                                Departement/Service: {{ $imputation->departement->nom }}</p>
                                        </div>
                                        <div class="my-4 text-center col-12">
                                            <h3 class="mb-0 text-uppercase">Annotations</h3>
                                        </div>
                                        <div class="row">
                                            @foreach ($annotation as $row)
                                            @foreach($imputation->courrier->annotations as $row2)
                                            @if ($row->id == $row2->pivot->annotation_id)
                                            <div class="col-md-3">
                                                <i class="fe fe-check fe-16 font-bold"></i> {{ $row->nom }}
                                            </div>
                                            @endif
                                            @endforeach
                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" disabled class="custom-control-input"
                                                        value="{{ $row->id }}" id="{{ $row->id }}">
                                                    <label class="custom-control-label" for="{{ $row->id }}">{{
                                                        $row->nom }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="ml-2 mt-2">
                                            <p class="text-dark">Autres Précisions:</p>
                                            <p class="text-dark">AUTRES ANNOTATIONS:</p>
                                        </div>
                                    </div>


                                    <!-- /.row -->

                                </div> <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header" id="heading1">
                    <a role="button" href="#collapse3" data-toggle="collapse" data-target="#collapse3"
                        aria-expanded="false" aria-controls="collapse3">
                        <strong>Fiche d'imputation du courrier</strong>
                    </a>
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" onClick="imputation('imputation')"
                                    class="mb-2 btn btn-success">Imprimer</button>
                                <div class="p-5" id="imputation">
                                    <div class="mb-5 row">
                                        <div class="mb-4 text-center col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="avatar-lg">
                                                        <img src="{{ asset('assets/images/favicon.png') }}"
                                                            class="rounded mr-5" alt="logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Direction nationale de l'economie</p>
                                                    <p>johnston.claudia@example.net</p>
                                                    <p>Contact: +17475384534</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <h2 class="mb-0 text-uppercase">fiche d'imputation N° {{ $imputation->id.'
                                                du
                                                '.$imputation->created_at->format('d/m/Y') }}</h2>

                                        </div>
                                        <div class="col-md-5">
                                            <p class="mb-2 text-dark text-uppercase font-weight-bolder">Numéro
                                                d’arrivée: N°{{
                                                $imputation->courrier->numero }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Références: {{
                                                $imputation->courrier->reference }}
                                            </p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Expediteur: {{
                                                $imputation->courrier->correspondant->prenom.' '.
                                                $imputation->courrier->correspondant->nom
                                                }}
                                            </p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Objet: {{
                                                $imputation->courrier->objet }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Date de fin
                                                traitement: {{
                                                $imputation->fin_traitement }}</p>
                                        </div>

                                        <div class="col-md-7">
                                            <p class="mb-2 text-dark text-uppercase font-weight-bolder">Date d'arrivée :
                                                {{
                                                date('d/m/Y',strtotime($imputation->courrier->date_arriver)) }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">En date du: {{
                                                date('d/m/Y',strtotime($imputation->courrier->date)) }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Type: {{
                                                $imputation->courrier->type
                                                }}</p>
                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">
                                                Departement/Service: {{
                                                $imputation->departement->nom}}</p>

                                            <p class="mb-2 text-dark font-weight-bolder text-uppercase">Listes des intervenants:
                                                @foreach ($imputation->diffusions as $row)
                                                {{ $row->departement->code }},
                                                @endforeach
                                            </p>
                                        </div>

                                    </div>

                                    <!-- /.row -->

                                </div> <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row  mx-auto">

        <form class="d-flex" action="{{ route('save.traitement') }}" method="post">
            @csrf
        <input type="hidden" name="id" value="{{ $imputation->courrier->id }}">
        <input type="hidden" name="imputation" value="{{ $imputation->id }}">
        <div class="col-md-4 mx-auto mb-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="valider" {{ $imputation->courrier->etat === "Traiter" ? 'checked' : '' }} {{ $imputation->courrier->etat === "Archiver" ? 'checked' : '' }} class="custom-control-input" id="Valider">
                <label class="custom-control-label" for="Valider">Traiter</label>
            </div>
        </div>
        <div class="col-md-4 mx-auto mb-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="archiver" {{ $imputation->courrier->etat === "Archiver" ? 'checked' : '' }} class="custom-control-input" id="Archiver">
                <label class="custom-control-label" for="Archiver">Archiver</label>
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="mb-2 btn btn-success">Enregistré</button>
        </div>
    </form>

    </div>
    {{-- fin courrier document --}}
</div>

<script>
    function imputation(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML; document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function circulation(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML; document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection

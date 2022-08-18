@extends('layouts.app')
@section('content')
<button type="button" onClick="imprimer('fiche')" id="print" class="mb-2 btn btn-success">Imprimer</button>
<h2 class="col-12 text-center">Evolution du courrier N° {{ $imputation->courrier->numero }} </h2>
<div class="stepper-wrapper pt-3">
    <div class="stepper-item {{  $imputation->courrier->etat === "Enregistré" || "Imputer" ? 'completed' : '' }}">
        <div class="step-counter"><i class="{{  $imputation->courrier->etat === " Enregistré" || "Imputer"
                ? 'fe fe-check' : '' }}"></i></div>
        <div class="step-name">Enregistrer</div>
    </div>
    <div class="stepper-item {{ $imputation->courrier->etat === "Imputer" || "Enregistré" ? 'completed' : '' }}">
        <div class="step-counter"><i class="{{ $imputation->courrier->etat === "Imputer" || "Enregistré" ? 'fe fe-check' : '' }}"></i>
        </div>
        <div class="step-name">Imputer</div>
    </div>
    <div class="stepper-item">
        <div class="step-counter {{ $imputation->courrier->etat === "Traiter" || "Imputer" ? 'completed' : '' }}"><i class="{{
            $imputation->courrier->etat === "Traiter" || "Imputer" ? 'fe fe-check' : ''}}"></i></div>
        <div class="step-name">Valider</div>
    </div>
    <div class="stepper-item">
        <div class="step-counter {{ $imputation->courrier->etat === "Archiver" ? 'completed' : '' }}">
        <i class="{{ $imputation->courrier->etat === "Archiver" || "Enregistré" || "Imputer" || "Traiter" ? 'fe fe-check' : ''}}"></i></div>
        <div class="step-name">Archiver</div>
    </div>
</div>
<div class="row">
    {{-- courrier document --}}
    <div class="col-12">
        <div class="file-container border-top" id="document">
            <div class="file-panel mt-4">
                <div class="row my-4">
                    @forelse ($imputation->courrier->documents as $row)
                    <div class="col-md-3">
                        <div class="card text-center mb-2 shadow">
                            <div class="card-body file">
                                <div class="file-action">
                                    <a target="_blank" href="{{ route('show.document',['id'=> $row->id]) }}"
                                        role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                    <a href="{{ route('edit.document',['id'=> $row->id]) }}" role="button"
                                        class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
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
    {{-- fin courrier document --}}
</div>
<div class="row">
    <div class="col-md-12 my-4">
        <div class="shadow card">
            <div class="p-5 card-body" id="fiche">
                <div class="mb-5 row">
                    <div class="mb-4 text-center col-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="avatar-lg">
                                    <img src="{{ asset('assets/images/favicon.png') }}" class="rounded mr-5" alt="logo">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <p>Direction nationale de l'economie</p>
                                <p>johnston.claudia@example.net</p>
                                <p>Contact: +17475384534</p>
                            </div>
                        </div>
                        <hr>
                        <h2 class="mb-0 text-uppercase">fiche d'imputation N° {{ $imputation->id.' du
                            '.$imputation->created_at->format('d/m/Y') }}</h2>

                    </div>
                    <div class="col-md-5">
                        <p class="mb-2 text-dark text-uppercase font-weight-bolder">Numéro d’arrivée: N°{{
                            $imputation->courrier->numero }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Références: {{
                            $imputation->courrier->reference }}
                        </p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Expediteur: {{
                            $imputation->courrier->correspondant->prenom.' '. $imputation->courrier->correspondant->nom
                            }}
                        </p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Objet: {{
                            $imputation->courrier->objet }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Date de fin traitement: {{
                            $imputation->fin_traitement }}</p>
                    </div>

                    <div class="col-md-7">
                        <p class="mb-2 text-dark text-uppercase font-weight-bolder">Date d'arrivée : {{
                            date('d/m/Y',strtotime($imputation->courrier->date_arriver)) }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">En date du: {{
                            date('d/m/Y',strtotime($imputation->courrier->date)) }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Type: {{ $imputation->courrier->type
                            }}</p>
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Departement/Service: {{
                            $imputation->departement->nom}}</p>

                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Diffusion(Pour avis):
                            @foreach ($imputation->diffusions as $row)
                            {{ $row->departement->code }},
                            @endforeach
                        </p>
                    </div>

                </div>

                <!-- /.row -->

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->


    </div>
</div>
<script>
    function imprimer(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML; document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection

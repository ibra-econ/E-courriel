@extends('layouts.app')
@section('content')
<div class="row">

    <button type="button" onClick="imprimer('fiche')" id="print" class="mb-2 btn btn-success">Imprimer</button>
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
                                <p> Morar-Bechtelar</p>
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
                        <p class="mb-2 text-dark font-weight-bolder text-uppercase">Departement/Service: {{ $imputation->departement->nom}}</p>

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

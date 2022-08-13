@extends('layouts.app')
@section('content')
<div class="row">
    <button type="button" id="print" onclick="imprimer('fiche')" class="btn btn-green-1">Imprimer</button>
    <div class="col-md-12 my-4">
        <div class="shadow card">
            <div class="p-5 card-body" id="fiche">
                <div class="mb-5 row">
                    <div class="mb-4 text-center col-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="avatar-lg">
                                    <img src="{{ asset('assets/images/favicon.png') }}" class="rounded mr-5" alt="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <p> Morar-Bechtelar</p>
                                <p>johnston.claudia@example.net</p>
                                <p>Contact: +17475384534</p>
                            </div>
                        </div>
                        <hr>
                        <h3 class="mb-0 mt-4 text-uppercase">
                            FICHE DE CIRCULATION COURRIER ARRIVEE N° {{ $courrier->numero }} <br>{{
                            $courrier->created_at->format('d/m/Y') }}</h3>
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
                </div>
                <div class="mb-4 text-center col-12">
                    <h3 class="mb-0 text-uppercase">Annotation</h3>
                </div>
                <div class="row">
                    @foreach ($annotation as $row)
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" value="{{ $row->id }}"
                                id="{{ $row->id }}">
                            <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mb-4 text-center col-12">
                    <h3 class="mb-0 text-uppercase">Imputation</h3>
                </div>
                <div class="row">
                    @foreach ($departement as $row)
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" value="{{ $row->id }}"
                                id="{{ $row->id }}">
                            <label class="custom-control-label" for="{{ $row->id }}">{{ $row->code }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="ml-2">
                    <p class="text-dark font-weight-bolder text-uppercase">Autres Précisions:</p>
                    <p class="text-dark font-weight-bolder text-uppercase">AUTRES ANNOTATIONS:</p>
                </div>

                <p class="text-center mt-2">NB : Tout courrier reçu doit faire l’objet d’une ventilation dans les 24
                    heures
                    qui suivent son arrivée.</p>

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

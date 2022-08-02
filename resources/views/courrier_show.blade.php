@extends('layouts.app')
@section('content')
<div class="row">


<div class="col-9">
    <div class="shadow card">
        <div class="p-5 card-body">
            <div class="mb-5 row">
                <div class="col-md-7">
                    <p class="mb-2 text-dark text-uppercase font-weight-bolder">Numéro d’arrivée: N°{{
                        $courrier->id }}</p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">Références: {{ $courrier->reference }}
                    </p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">Expediteur: {{ $courrier->emetteur }}
                    </p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">Destinateur: {{ $courrier->destinateur
                        }}</p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">Objet: {{ $courrier->objet }}</p>
                </div>
                <div class="col-md-5">
                    <p class="mb-2 text-dark text-uppercase font-weight-bolder">Date d'arrivée : {{
                        date('d/m/Y',strtotime($courrier->date_arriver)) }}</p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">En date du: {{
                       date('d/m/Y',strtotime($courrier->date)) }}</p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">Type: {{ $courrier->type }}</p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">Priorité: {{ $courrier->priorite }}</p>
                    <p class="mb-2 text-dark font-weight-bolder text-uppercase">confidentiel: {{ $courrier->confidentiel }}</p>
                </div>
            </div>
             <!-- /.row -->

            {{-- include annotation et imputation --}}
            <hr>

            <h3 class="text-center">ANNOTATION</h3>
            <div class="row mt-5">
                {{-- @forelse ($courrier->annotations as $row)
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input wire:model="annotation" type="checkbox" class="custom-control-input" value="{{ $row->pivot->id }}" id="{{ $row->pivot->id }}">
                        <label class="custom-control-label" for="{{ $row->pivot->id }}">{{ $row->pivot->nom }}</label>
                    </div>
                </div>
                @empty
                <h3 class="text-center">Aucune annotation</h3>
                @endforelse --}}
            </div> <!-- /.row -->
            <hr>
            <h3 class="text-center">IMPUTATION</h3>
            <div class="row mt-5">
                @forelse ($courrier->departements as $row)
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input wire:model="imputation" type="checkbox" class="custom-control-input" value="{{ $row->pivot->id }}" id="imputation{{ $row->pivot->id }}">
                        <label class="custom-control-label" for="imputation{{ $row->pivot->id }}">{{ $row->pivot->imputation }}</label>
                    </div>
                </div>
                @empty
                <h3 class="text-center">Aucune imputation</h3>
                @endforelse
            </div> <!-- /.row -->
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->
</div> <!-- /.col-12 -->
<div class="col-3">
    @forelse ($courrier->documents as $row)
    <div class="col-md-12">


        <div class="card text-center mb-4 shadow-lg">
          <div class="card-body file">
            <div class="file-action">
              <a href="{{ Storage::url($row->chemin) }}" role="button" class="btn mb-2 btn-secondary"><span class="fe fe-download fe-16"><span></span></span></a>
            </div>
            <div class="circle circle-lg bg-light my-4">
              <span class="fe fe-file fe-24 text-success"></span>
            </div>
            <div class="file-info">

              <span class="badge badge-pill badge-light text-muted">PDF</span>
            </div>
          </div> <!-- .card-body -->
          <div class="card-footer bg-transparent border-0 fname">
            <strong>Document</strong>
            <strong>crée: {{ date('d/m/Y',strtotime($row->created_at)) }}</strong>
          </div> <!-- .card-footer -->
        </div> <!-- .card -->
    </div>

    @empty
        Aucun document
    @endforelse
</div> <!-- .col -->
</div>
@endsection

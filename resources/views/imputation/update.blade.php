@extends('layouts.app')
@section('content')
<div class="">
    @if (Session::has('update'))
    <div class="alert alert-info alert-dismissible text-center fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ Session::get('update') }}</strong>
    </div>
    @endif
</div>
<div class="card">
    <div class="modal-header">
        <h5 class="card-title">Formulaire de mise à jour</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('update.imputation') }}" method="POST" class="p-3 needs-validation" novalidate>
            @csrf
            <input type="hidden" name="id" value="{{ $imputation->id }}">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="simple-select2">Courrier</label>
                    <select class="form-control select2" name="courrier" id="simple-select2" required>
                        @foreach ($courrier as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $imputation->courrier_id ? 'selected' : '' }}>Courrier N°{{
                            $row->numero.'-ref '.$row->reference.'-Objet '.$row->objet }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="simple-select2">Département/Service traitement</label>
                    <select class="form-control select2" name="departement" id="simple-select2" required>
                        @foreach ($departement as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $imputation->departement_id ? 'selected' : '' }}>{{ $row->nom }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom04">Diffusion (Pour avis)</label>
                  <select class="form-control select2-multi" name="diffusion[]" multiple="multiple" id="validationCustom04">
                    <optgroup label="Departement">
                        @foreach ($departement as $row)
                        @foreach ($imputation->departements as $row2)
                          <option value="{{ $row->id }}" {{ $row->id == $row2->pivot->departement_id ? 'selected' : '' }}>{{ $row->nom }}</option>
                        @endforeach
                        <option value="{{ $row->id }}">{{ $row->nom }}</option>
                        @endforeach
                    </optgroup>
                  </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>

                <div class="text-center col-12">
                    <h4>ANNOTATION</h4>
                </div>

            </div>
            <div class="row mt-5">
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
                <div class="text-center">
                    <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="mb-2 btn btn-success">Valider</button>
                </div>
        </form>
    </div>
</div>

@endsection

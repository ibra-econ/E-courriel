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
        <form method="POST" action="{{ route('update.departement') }}" class="needs-validation p-3" novalidate>
            @csrf
            <input type="hidden" name="id" value="{{ $departement->id }}">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Nom</label>
                    <input value="{{ $departement->nom }}" type="text" name="nom" class="form-control"
                        id="validationCustom02" placeholder="Entrez le nom du departement" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Code</label>
                    <input type="text" value="{{ $departement->code }}" name="code" class="form-control"
                        id="validationCustom02" placeholder="Entrez le code" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('Departement') }}" role="button" class="btn mb-2 btn-secondary">Annuler</a>
                <button type="submit" class="btn mb-2 btn-success">Valider</button>

            </div>
        </form>

    </div>
</div>

@endsection

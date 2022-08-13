@extends('layouts.app')
@section('content')
<div class="text-center">
    @if (Session::has('update'))
    <div class="text-center alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ Session::get('update') }}</strong>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-center">Formulaire de mise à jour</h2>
                <form method="post" action="{{ route('update.correspondant') }}" class="needs-validation p-3"
                    novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Nom</label>
                            <input type="text" class="form-control" id="validationCustom02" value="{{ $row->nom }}"
                                name="nom" placeholder="Entrez le nom du correspondant" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Prénom</label>
                            <input type="text" class="form-control" id="validationCustom02" name="prenom"
                                placeholder="Entrez le prenom du correspondant" value="{{ $row->prenom }}" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Email (Facultatif)</label>
                            <input type="email" class="form-control" value="{{ $row->email }}" id="validationCustom02"
                                name="email" placeholder="Entrez email du correspondant">
                            <div class="valid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Telephone</label>
                            <input type="text" class="form-control" value="{{ $row->phone }}" id="validationCustom02"
                                name="phone" placeholder="Entrez le contact du correspondant">
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Fonction/Profession</label>
                            <input type="text" class="form-control" value="{{ $row->fonction }}" id="validationCustom02"
                                name="fonction" placeholder="Entrez la fonction du correspondant">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>

                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('Correspondant') }}" role="button" class="btn mb-2 btn-secondary"
                            data-dismiss="modal">Annuler</a>
                        <button type="submit" class="btn mb-2 btn-green-1">Valider</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection

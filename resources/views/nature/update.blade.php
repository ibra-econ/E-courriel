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
<div class="row">
    <div class="col-md-6 mx-auto" role="document">
        <div class="card">
            <div class="card-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de mise à jour</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.nature') }}" method="POST" class="needs-validation p-3" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $nature->id }}" name="id">
                    <div class="mb-3">
                        <label for="validationCustom02">Nom</label>
                        <input type="text" value="{{ $nature->nom }}" name="nom" class="form-control"
                            id="validationCustom02" value="" placeholder="Entrez le nom de la nature" required>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>

                    <div class="modal-footer">
                        <div class="text-center">
                            <a href="{{ route('Nature') }}" role="button" class="btn mb-2 btn-secondary"
                                data-dismiss="modal">Annuler</a>
                            <button type="submit" class="btn mb-2 btn-green-1">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

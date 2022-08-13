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
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="modal-header">
                <h5 class="card-title">Formulaire de mise à jour</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update.annotation') }}" class="needs-validation p-3" novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{ $annotation->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02">Nom</label>
                                <input type="text" value="{{ $annotation->nom }}" name="nom" class="form-control"
                                    id="validationCustom02" placeholder="Entrez le nom de l'annotation" required>
                                <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <a href="{{ route('Annotation') }}" role="button" class="btn mb-2 btn-secondary">Annuler</a>
                        <button type="submit" class="btn mb-2 btn-green-1">Valider</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection

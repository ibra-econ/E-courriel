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
                <form method="POST" action="{{ route('update.document') }}" class="needs-validation p-3" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{ $document->id }}">
                    {{-- <input type="hidden" name="lien" value="{{ $document->chemin }}"> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationCustom02">Nom</label>
                                <input type="text" value="{{ $document->libelle }}" name="libelle" class="form-control"
                                    id="validationCustom02" placeholder="Entrez le nom du document" required>
                                <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                              <label for="document" class="form-label">Document</label>
                              <input type="file" class="form-control" name="document" id="document">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route("document") }}" role="button" class="btn mb-2 btn-secondary">Annuler</a>
                        <button type="submit" class="btn mb-2 btn-success">Valider</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection

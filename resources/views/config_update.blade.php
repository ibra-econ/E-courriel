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
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de mise à jour</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.config') }}" method="POST" class="needs-validation p-3"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $config->id }}" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom02">Nom (Raison Social)</label>
                                    <input type="text" value="{{ $config->nom }}" name="nom" class="form-control"
                                        id="validationCustom02" value="" placeholder="Entrez le nom de la nature"
                                        required>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom02">Contact</label>
                                    <input type="text" value="{{ $config->contact }}" name="contact"
                                        class="form-control" id="validationCustom02" value=""
                                        placeholder="Entrez le contact de la structure" required>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom02">Email</label>
                                    <input type="email" value="{{ $config->email }}" name="email" class="form-control"
                                        id="validationCustom02" value="" placeholder="Entrez email de la structure"
                                        required>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img src="{{ Storage::url($config->logo) }}" alt="logo" class="avatar-img rounded">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control" name="logo" id="logo"
                                    aria-describedby="fileHelpId">
                            </div>
                        </div>
                        <div class="col-md-12 py-2">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description"
                                    rows="3">{{ $config->description }}</textarea>
                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn mb-2 btn-success">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

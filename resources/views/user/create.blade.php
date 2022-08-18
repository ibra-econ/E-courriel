@extends('layouts.app')
@section('content')
<div class="">
    @if (Session::has('insert'))
    <div class="text-center alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ Session::get('insert') }}</strong>
    </div>
    @endif
    @if ($errors->any())
    <div class="font-medium text-danger">
        {{ __("Oups ! Quelque chose s'est mal passé") }}
    </div>

    <ul class="mt-3 text-sm text-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>
<div class="card">
    <div class="modal-header">
        <h5 class="card-title">Formulaire de nouveau utilisateur</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('new.user') }}" class="p-3 needs-validation" novalidate>
            @csrf
            <div class="form-row">
                <div class="mb-3 col-md-6">
                    <label for="validationCustom02">Name</label>
                    <input type="text" class="form-control" id="validationCustom02" name="name"
                        placeholder="Entrez le nom d'utilisateur" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="validationCustom02">Email</label>
                    <input type="email" class="form-control" id="validationCustom02" name="email"
                        placeholder="Entrez email de d'utilisateur" required>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="photo" class="form-label">Photo (Facultatif)</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="simple-select2">Type (Role)</label>
                    <select class="form-control select2" name="role" id="simple-select2" required>
                        <option selected disabled value="">Selectionner</option>
                        @if (Auth::user()->role === 'admin')
                        <option value="admin">Admin (Administrateur)</option>
                        @endif
                        <option value="superuser">Superuser (Chef departement, Directeur)</option>
                        <option value="agent">Secretaire (Secretariat)</option>
                        <option value="agent">Agent (Agent courrier)</option>
                    </select>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="simple-select3">Poste</label>
                    <input type="text" class="form-control" id="validationCustom02" name="poste"
                    placeholder="Entrez le poste" required>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    <div class="valid-feedback"></div>
                </div>
                @if (Auth::user()->role === 'admin')
                <div class="mb-3 col-md-12">
                    <label for="simple-select4">Departement</label>
                    <select class="form-control select2" name="departement" id="simple-select4" required>
                        <option selected disabled value="">Selectionner</option>
                        @forelse ($departement as $row)
                        <option value="{{ $row->id }}">{{ $row->nom }}</option>
                        @empty
                        <option value="">Aucun departement</option>
                        @endforelse
                    </select>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    <div class="valid-feedback"></div>
                </div>
                @endif
                <div class="mb-3 col-md-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" required class="form-control" id="password"
                        autocomplete="new-password">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>

                </div>
                <div class="mb-3 col-md-6">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required class="form-control"
                        id="password_confirmation">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>

                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('Compte') }}" role="button" class="mb-2 btn btn-secondary">Annuler</a>
                <button type="submit" class="mb-2 btn btn-green-1">Valider</button>

            </div>
        </form>

    </div>
</div>

@endsection

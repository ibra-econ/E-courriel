@extends('layouts.app')
@section('content')
<div class="">
    @if (Session::has('insert'))
    <div class="alert alert-info alert-dismissible text-center fade show" role="alert">
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
        <form method="POST" action="{{ route('new.user') }}" class="needs-validation p-3" novalidate>
            @csrf
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Name</label>
                    <input type="text" class="form-control" id="validationCustom02" name="name"
                        placeholder="Entrez le nom d'utilisateur" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Email</label>
                    <input type="email" class="form-control" id="validationCustom02" name="email"
                        placeholder="Entrez email de d'utilisateur" required>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="col-md-12 mb-3">
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
                        {{-- <option value="stantard">Stantard (Personnel de departement)</option> --}}
                    </select>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="simple-select3">Poste</label>
                    <select class="form-control select2" name="poste" id="simple-select3" required>
                        <option selected disabled value="">Selectionner</option>
                        @forelse ($poste as $row)
                        <option value="{{ $row->id }}">{{ $row->nom }}</option>
                        @empty
                        <option value="">Aucun poste</option>
                        @endforelse
                    </select>
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
                <div class="col-md-12 mb-3">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" required type="text" class="form-control" id="password"
                        autocomplete="new-password">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>

                </div>
                <div class="col-md-12 mb-3">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required type="text" class="form-control"
                        id="password_confirmation">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>

                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('Compte') }}" role="button" class="btn mb-2 btn-secondary">Annuler</a>
                <button type="submit" class="btn mb-2 btn-green-1">Valider</button>

            </div>
        </form>

    </div>
</div>

@endsection

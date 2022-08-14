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
        <form method="POST" action="{{ route('update.user') }}" class="needs-validation p-3" novalidate>
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="validationCustom02">Nom d'utilisateur</label>
                        <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                            id="validationCustom02" placeholder="Entrez le nom de l'utilisateur" required>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="validationCustom02">Email</label>
                        <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                            id="validationCustom02" placeholder="Entrez email de l'utilisateur" required>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="simple-select2">Poste</label>
                        <div class="mb-3 col-md-6">
                            <label for="simple-select3">Poste</label>
                            <input value="{{ $user->poste }}" type="text" class="form-control" id="validationCustom02" name="name"
                            placeholder="Entrez le poste" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role === "admin")
                <div class="col-md-4 mb-3">
                    <label for="simple-select4">Département</label>
                    <select class="form-control select2" name="departement" id="simple-select4" required>
                        @foreach ($departement as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $user->departement_id ? 'selected' : ''
                            }}>{{ $row->nom }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="simple-select3">Role</label>
                        <select class="form-control select2" name="role" id="simple-select3" required>
                            <option value="admin" {{ $user->role === "admin" ? 'selected' : ''}}>Admin (Administrateur)
                            </option>
                            <option value="superuser" {{ $user->role === "superuser" ? 'selected' : ''}}>Superuser
                                (Chef departement, Directeur)</option>
                            <option value="agent" {{ $user->role === "secretaire" ? 'selected' : ''}}>Secretaire
                                (Secretariat)</option>
                            <option value="agent" {{ $user->role === "agent" ? 'selected' : ''}}>Agent (
                                Agent courrier)</option>

                        </select>
                    </div>
                </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('Compte') }}" role="button" class="btn mb-2 btn-secondary">Annuler</a>
                <button type="submit" class="btn mb-2 btn-green-1">Valider</button>

            </div>
        </form>

    </div>
</div>

@endsection

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
                <form action="{{ route('update.diffusion') }}" method="POST" class="needs-validation p-3" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $diffusion->id }}" name="id">
                   <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="simple-select4">Departement</label>
                        <select class="form-control select2" name="nature" id="simple-select4" required>
                            @foreach ($departement as $row)
                            <option value="{{ $row->id }}" {{ $row->id == $diffusion->departement_id ? 'selected' : ''
                                }}>{{ $row->nom }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>
                   </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <a href="{{ route('Diffusion') }}" role="button" class="btn mb-2 btn-secondary"
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

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
    <div class="col-9">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-center">Formulaire de mise à jour</h2>
                <form action="{{ route('update.courrier') }}" method="POST" class="p-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{ $courrier->id }}">
                    <div class="form-row">
                        <div class="mb-3 col-md-6">
                            <label for="simple-select2">Type (Depart/Arrivee)</label>
                            <select class="form-control select2" name="type" id="simple-select2" required>
                                <option value="depart" {{ $courrier->type === "depart" ? 'selected' : '' }} >Courrier
                                    départ</option>
                                <option value="arriver" {{ $courrier->type === "arriver" ? 'selected' : '' }}>Courrier
                                    arrivée</option>
                                    <option value="interne" {{ $courrier->type === "interne" ? 'selected' : '' }}>Courrier
                                        interne</option>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="simple-select3">Confidentiel</label>
                            <select class="form-control select2" name="confidentiel" id="simple-select3" required>
                                <option value="OUI" {{ $courrier->confidentiel === "OUI" ? 'selected' : '' }}>OUI
                                </option>
                                <option value="NON" {{ $courrier->confidentiel === "NON" ? 'selected' : '' }}>NON
                                </option>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="simple-select7">Priorite</label>
                            <select class="form-control select2" name="priorite" id="simple-select7" required>
                                <option value="Normal" {{ $courrier->priorite === "Normal" ? 'selected' : '' }}>Normal
                                </option>
                                <option value="Urgent" {{ $courrier->priorite === "Urgent" ? 'selected' : '' }}>Urgent
                                </option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="simple-select4">Nature (Fax/Lettre/Email)</label>
                            <select class="form-control select2" name="nature" id="simple-select4" required>
                                @foreach ($nature as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $courrier->nature_id ? 'selected' : ''
                                    }}>{{ $row->nom }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="simple-select5">Correspondant (Destinateur/Expediteur)</label>
                            <select class="form-control select2" name="correspondant" id="simple-select5" required>
                                <option selected disabled value="">Selectionner</option>
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $courrier->correspondant_id ? 'selected' :
                                    '' }}>{{ $row->prenom }} {{ $row->nom }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">En date du</label>
                            <input type="date" name="date" value="{{ $courrier->date }}" class="form-control"
                                id="validationCustom02" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">Date arrivée</label>
                            <input type="date" name="date_arriver" value="{{ $courrier->date_arriver }}"
                                class="form-control" id="validationCustom02" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">Objet</label>
                            <input type="text" class="form-control" value="{{ $courrier->objet }}" name="objet"
                                id="validationCustom02" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Fichiers Scanner</label>
                            <input type="file" multiple class="form-control" name="document[]" id="" placeholder=""
                                aria-describedby="fileHelpId">
                        </div>
                        @if (Auth::user()->role === "admin")
                        <div class="mb-3 col-md-3">
                            <label for="simple-select6">Etat</label>
                            <select class="form-control select2" name="etat" id="simple-select6" required>

                                <option value="Enregistré" {{ $courrier->etat === "Enregistré" ? 'selected' : ''
                                    }}>Enregistrer</option>
                                <option value="Imputer" {{ $courrier->etat === "Imputer" ? 'selected' : '' }}>Imputer
                                </option>
                                <option class="Archiver" {{ $courrier->etat === "Archiver" ? 'selected' : '' }}>Archiver
                                </option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        @endif

                    </div>
                    <div class="text-center">
                        <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="mb-2 btn btn-green-1">Valider</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="col-3">
        @forelse ($courrier->documents as $row)
        <div class="col-md-12">
            <div class="card text-center mb-4 shadow">
                <div class="card-body file">
                    <div class="file-action">
                        <a href="{{ route('edit.document',['id'=> $row->id]) }}" role="button"
                            class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                    </div>
                    <div class="circle circle-lg bg-light my-4">
                        <span class="fe fe-file fe-24 text-success"></span>
                    </div>
                    <div class="file-info">

                        <span class="badge badge-pill badge-light text-muted">PDF</span>
                    </div>
                </div> <!-- .card-body -->
                <div class="card-footer bg-transparent border-0 fname">
                    <strong>Document</strong> <br>
                    <strong>crée: {{ date('d/m/Y',strtotime($row->created_at)) }}</strong>
                </div> <!-- .card-footer -->
            </div> <!-- .card -->
        </div>

        @empty
        Aucun document
        @endforelse
    </div>

</div>
</div>
@endsection

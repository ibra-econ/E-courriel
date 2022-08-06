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
                            <label for="validationCustom04">Type (Depart/Interne/Arrivee)</label>
                            <select class="custom-select" name="type" id="validationCustom04" required>
                                @if ($courrier->type === "depart")
                                <option selected value="depart">Courrier départ</option>
                                <option value="arriver">Courrier arrivée</option>
                                <option value="interne">Courrier interne</option>
                                @endif
                                @if ($courrier->type === "arriver")
                                <option value="depart">Courrier départ</option>
                                <option selected value="arriver">Courrier arrivée</option>
                                <option value="interne">Courrier interne</option>
                                @endif
                                 @if ($courrier->type === "interne")
                                 <option value="depart">Courrier départ</option>
                                 <option value="arriver">Courrier arrivée</option>
                                 <option selected value="interne">Courrier interne</option>
                                @endif

                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Confidentiel</label>
                            <select class="custom-select" name="confidentiel" id="validationCustom04" required>
                                @if ($courrier->confidentiel === "OUI")
                                <option selected value="OUI">OUI</option>
                                <option value="NON">NON</option>
                               @endif
                               @if ($courrier->confidentiel === "NON")
                               <option value="OUI">OUI</option>
                               <option selected value="NON">NON</option>
                              @endif
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Réference</label>
                            <input type="text" value="{{ $courrier->reference }}" name="reference" class="form-control"
                                id="validationCustom02" placeholder="Entrez la reference du courrier" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="validationCustom04">Nature (Fax/Lettre/Email)</label>
                            <select class="custom-select" name="nature" id="validationCustom04" required>
                                @foreach ($nature as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $courrier->nature_id ? 'selected' : '' }}>{{ $row->nom }}</option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom04">Correspondant (Destinateur/Expediteur)</label>
                            <select class="custom-select" name="correspondant" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner</option>
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $courrier->correspondant_id ? 'selected' : '' }}>{{ $row->prenom }} {{ $row->nom }}</option>
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
                            {{-- <div id="fileHelpId" class="form-text">Help text</div> --}}

                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Etat</label>
                            <select class="custom-select" name="etat" id="validationCustom04" required>
                                @if ($courrier->etat === "A Envoyer")
                                <option selected value="A Envoyer">A Envoyer</option>
                                <option value="A Traiter">A Traiter</option>
                                <option class="Archiver">Archiver</option>
                                @endif
                                @if ($courrier->etat === "A Traiter")
                                <option value="A Envoyer">A Envoyer</option>
                                <option selected value="A Traiter">A Traiter</option>
                                <option class="Archiver">Archiver</option>
                                @endif
                                @if ($courrier->etat === "Archiver")
                                <option value="A Envoyer">A Envoyer</option>
                                <option value="A Traiter">A Traiter</option>
                                <option selected class="Archiver">Archiver</option>
                                @endif
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Priorite</label>
                            <select class="custom-select" name="priorite" id="validationCustom04" required>

                                @if ($courrier->priorite === "Normal")
                                <option selected value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                                @endif
                                @if ($courrier->priorite === "Urgent")
                                <option value="Normal">Normal</option>
                                <option selected value="Urgent">Urgent</option>
                                @endif

                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="mb-2 btn btn-success">Valider</button>
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
                        <a href="{{ route('edit.courrier',['id'=> $row->id]) }}" role="button"
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

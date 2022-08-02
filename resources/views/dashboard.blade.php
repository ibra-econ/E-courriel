@extends('layouts.app')
@section('content')
{{-- star statisitique --}}
<div class="row">
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-trending-up text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Départ</p>
                        <span class="mb-0 text-white h3">{{ $depart }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-trending-down text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Arrivées</p>
                        <span class="mb-0 text-white h3">{{ $arriver }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-users text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total utilisateurs</p>
                        <span class="mb-0 text-white h3">{{ $user }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end section -->
{{-- end statisitique --}}
@if (Session::has('insert'))
<div class="text-center alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong> {{ Session::get('insert') }}</strong>
</div>
@endif
{{-- courrier table --}}
<div class="row">
    <div class="my-4 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Courrier Dashboard</h5>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="mb-2 border-0 btn btn-green-1" data-toggle="modal"
                            data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>

                    </div>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Réference</th>
                            <th>User</th>
                            <th>Nature</th>
                            <th>Type</th>
                            <th>Priorité</th>
                            <th>Emetteur</th>
                            <th>Destinateur</th>
                            <th>Fichier</th>
                            <th>Etat</th>
                            <th>Date arrivée</th>
                            <th>Crée</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->reference }}</td>
                            <td> {{ $row->user->name }}</td>
                            <td>{{ $row->nature->nom }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->priorite }}</td>
                            <td>{{ $row->emetteur }}</td>
                            <td>{{ $row->destinateur }}</td>
                            <td><i class="fe fe-folder"></i></td>
                            <td><span class="badge badge-pill badge-success text-white">{{ $row->etat }}</span></td>
                            <td>{{ date('d/m/Y',strtotime($row->date_arriver)) }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('show.courrier',['id'=> $row->id]) }}" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                <a href="{{ route('edit.courrier',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bordered table -->

</div> <!-- end courrier -->
</div>
{{-- modal forme new courrier --}}
<!-- Modal -->
<div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de nouveau Courrier</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('new.courrier') }}" method="POST" class="p-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom04">Type de Courrier (Depart/Arrivee)</label>
                            <select class="custom-select" name="type" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="départ">Courrier départ</option>
                                <option value="arrivée">Courrier arrivée</option>
                                <option value="interne">Courrier interne</option>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Confidentiel</label>
                            <select class="custom-select" name="confidentiel" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Réference</label>
                            <input type="text" name="reference" class="form-control" id="validationCustom02"
                                placeholder="Entrez la reference du courrier" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="validationCustom04">Nature (Fax/Lettre)</label>
                            <select class="custom-select" name="nature" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner</option>
                                @foreach ($nature as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02"> Expéditeur</label>
                            <input type="text" name="emetteur" class="form-control" id="validationCustom02"
                                placeholder="Entrez expéditeur du courrier" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">Destinateur</label>
                            <input type="text" name="destinateur" class="form-control" id="validationCustom02"
                                placeholder="Entrez destinateur du courrier" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">En date du</label>
                            <input type="date" name="date" class="form-control" id="validationCustom02" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">Date arrivée</label>
                            <input type="date" name="date_arriver" class="form-control" id="validationCustom02"
                                required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">Objet</label>
                            <input type="text" class="form-control" name="objet" id="validationCustom02" required>
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
                                <option selected disabled value="">Selectionner</option>
                                <option value="A Envoyer">A Envoyer</option>
                                <option value="A Traiter">A Traiter</option>
                                <option class="Archiver">Archiver</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Priorite</label>
                            <select class="custom-select" name="priorite" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="mb-2 btn btn-success">Valider</button>
                            <p>NB : Tout courrier reçu doit faire l’objet d’une ventilation dans les 24 heures
                                qui suivent son arrivée.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<Script>
    function deleteConfirmation(id) {
    swal.fire({
        title: "Supprimer?",
        icon: 'question',
        text: "Etes vous sur de vouloir supprimer cet element!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Oui, Supprimer!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: !0
    }).then(function (e) {

        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "{{url('delete/courrier')}}/" + id,
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function (results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        // refresh page after 2 seconds
                        setTimeout(function(){
                            location.reload();
                        },2000);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });

        } else {
            e.dismiss;
        }

    }, function (dismiss) {
        return false;
    })
    }
</Script>
@endsection

@extends('layouts.app')
@section('content')
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
                    <h5 class="card-title">Listes des courrier départ</h5>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="mb-2 border-0 btn btn-green-1" data-toggle="modal"
                            data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>
                        {{-- si user est admin --}}
                        @if (Auth::user()->isAdmin())
                        <a href="{{ route('corbeille.courrier') }}" role="button"
                            class="btn mb-2 btn-danger text-white ml-2"> <i class="fe fe-trash-2"></i> Corbeille {{
                            $corbeille }}</a>
                        @endif
                    </div>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Réference</th>
                            <th>Numero</th>
                            <th>Utilisateur</th>
                            <th>Nature</th>
                            <th>Type</th>
                            <th>Priorité</th>
                            <th>correspondant</th>
                            <th>Etat</th>
                            <th>Date depart</th>
                            <th>Crée</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->reference }}</td>
                            <td>{{ $row->numero }}</td>
                            <td> {{ $row->user->name }}</td>
                            <td>{{ $row->nature->nom }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->priorite }}</td>
                            <td>{{ $row->correspondant->prenom.' '.$row->correspondant->nom }}</td>
                            <td><span class="badge badge-pill badge-success text-white">{{ $row->etat }}</span></td>
                            <td>{{ date('d/m/Y',strtotime($row->date_arriver)) }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>

                                <a href="{{ route('edit.courrier',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                                @if (Auth::user()->isAdmin())
                                    <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                        class="btn btn-sm btn-green-1  mt-1"><i class="fe fe-trash"></i></button>
                                @endif

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

                    <input type="hidden" name="type" value="depart">
                    <input type="hidden" name="numero" value="{{ $numero == null ? 1 : $numero->numero +1 }}">
                    <div class="form-row">
                        <div class="mb-3 col-md-3">
                            <label for="simple-select2">Type de Courrier</label>
                            <select class="form-control select2" id="simple-select2" disabled required>
                                <option selected value="depart">Courrier depart</option>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="simple-select2">Priorite</label>
                            <select class="form-control select2" name="priorite" id="simple-select2" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="simple-select3">Confidentiel</label>
                            <select class="form-control select2" name="confidentiel" id="simple-select3" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Réference</label>
                            <input type="text" name="reference" value="{{ $numero == null ? 1 : 'CD-N°'.$numero->numero +1 }}/{{ Auth::user()->departement->code }}" class="form-control" id="validationCustom02"
                                placeholder="Entrez la reference du courrier" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="simple-select4">Nature (Fax/Lettre)</label>
                            <select class="form-control select2" name="nature" id="simple-select4" required>
                                <option selected disabled value="">Selectionner</option>
                                @foreach ($nature as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="validationCustom04">Numero</label>
                            <input type="text" value="{{ $numero == null ? 1 : $numero->numero +1 }}" disabled readonly
                                class="form-control" id="validationCustom02" required>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="simple-select5">Correspondant (Destinateur/Expediteur)</label>
                            <select class="form-control select2" name="correspondant" id="simple-select5" required>
                                <option selected disabled value="">Selectionner</option>
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}">{{ $row->prenom }} {{ $row->nom.' '.$row->fonction }}
                                </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">En date du</label>
                            <input type="date" name="date" class="form-control" id="validationCustom02" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validationCustom02">Date de départ</label>
                            <input type="date" name="date_arriver" class="form-control" id="validationCustom02"
                                required>
                            <div class="valid-feedback"></div>
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
                        </div>


                    </div>

                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="mb-2 btn btn-green-1">Valider</button>
                            <p>NB : Tout courrier reçu doit faire l’objet d’une ventilation dans les 24 heures
                                qui suivent son arrivée.</p>
                        </div>
                    </div>
                </form>
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
@section('scroll')
scrollX: true,
@endsection

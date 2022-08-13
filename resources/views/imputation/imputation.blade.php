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
</div>
{{-- courrier imputation table --}}
<div class="row">
    <div class="my-2 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des imputations</h5>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="mb-2 border-0 btn btn-green-1" data-toggle="modal"
                            data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>
                            @if (Auth::user()->role === "admin")
                        <a href="{{ route('corbeille.imputation') }}" role="button"
                            class="btn mb-2 ml-2 btn-danger text-white"> <i class="fe fe-trash-2"></i> Corbeille {{
                            $corbeille }}</a>
                            @endif
                    </div>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Poste</th>
                            <th>Réference</th>
                            <th>Numero</th>
                            <th>Type</th>
                            <th>Expediteur</th>
                            <th>Departement</th>
                            <th>Date arrivée</th>
                            <th>Fin Traitement</th>
                            <th>Crée</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->user->poste->nom }}</td>
                            <td>{{ $row->courrier->reference }}</td>
                            <td>{{ $row->courrier->numero }}</td>
                            <td>{{ $row->courrier->type }}</td>
                            <td>{{ $row->courrier->correspondant->nom.' '.$row->courrier->correspondant->prenom }}</td>
                            <td>{{ $row->departement->nom }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->courrier->date_arriver)) }}</td>
                            <td>{{ $row->fin_traitement }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if (Auth::user()->role === "admin" || "secretaire" || "superuser")
                                <a href="{{ route('show.imputation', ['id' => $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-eye"></i></a>

                                    @endif
                                    @if (Auth::user()->role === "admin" || "superuser")
                                    <a href="{{ route('pdf.imputation', ['id' => $row->id]) }}" role="button"
                                        class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-download"></i></a>
                                <a href="{{ route('edit.imputation', ['imputation' => $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-edit"></i></a>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-trash"></i></button>
                                    @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- end courrier imputation -->


<div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de nouvelle imputation</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('new.imputation') }}" method="POST" class="p-3 needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="simple-select3">Courrier</label>
                            <select class="form-control select2" name="courrier" id="simple-select3" required>
                                <option selected disabled value="">Selectionner un courrier</option>
                                @forelse ($courrier as $row)
                                <option value="{{ $row->id }}">Courrier N°{{
                                    $row->numero.'-reference '.$row->reference.'-Objet '.$row->objet }}</option>
                                @empty
                                <option>Aucun courrier</option>
                                @endforelse
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="simple-select4">Notifié le destinateur par email</label>
                            <select class="form-control select2" name="notif" id="simple-select4" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="simple-select2">Département/Service traitement</label>
                            <select class="form-control select2" name="departement" id="simple-select2" required>
                                <option selected disabled value="">Selectionner</option>
                                @forelse ($departement as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @empty
                                <option>Aucun departement</option>
                                @endforelse
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Diffusion (Pour avis) Facultatif</label>
                            <select class="form-control select2-multi" name="diffusion[]" multiple="multiple"
                                id="validationCustom04">
                                <optgroup label="Departement">
                                    @forelse ($departement as $row)
                                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                    @empty
                                    <option>Aucun departement</option>
                                    @endforelse
                                </optgroup>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>
                    <div class="text-center col-12">
                        <h4>ANNOTATION</h4>
                    </div>
                    <div class="row mt-5">
                        @forelse($annotation as $row)
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" name="annotation[]" class="custom-control-input"
                                    value="{{ $row->id }}" id="{{ $row->id }}">
                                <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <h3 class="text-center">Vous avez aucune annotation</h3>
                        </div>
                        @endforelse
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Observation (Facultatif)</label>
                                <textarea class="form-control" name="observation" id="" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="mb-2 btn btn-green-1">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
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
                url: "{{url('delete/imputation')}}/" + id,
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
</script>
@endsection
@section('scroll')
scrollX: true,
@endsection

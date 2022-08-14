@extends('layouts.app')
@section('content')
@if (Session::has('insert'))
<div class="alert alert-info alert-dismissible text-center fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong> {{ Session::get('insert') }}</strong>
</div>
@endif
{{-- departement table --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des departements</h5>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group col-auto mr-auto">
                                <button type="button" class="btn mb-2 btn-green-1" data-toggle="modal"
                                    data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>
                                <a href="{{ route('corbeille.departement') }}" role="button"
                                    class="btn mb-2 btn-danger text-white"> <i class="fe fe-trash-2"></i> Corbeille {{
                                    $corbeille }}</a>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Utilisateurs</th>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->nom }}</td>
                            <td>{{ $row->users->count() }}</td>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('edit.departement',['id'=> $row->id]) }}" role="button"
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
    </div> <!-- Bordered table -->
</div> <!-- Fin Département -->
</div>

{{-- modal forme Nouveau Département --}}
<!-- Modal -->
<div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">Nouveau Département</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('new.departement') }}" class="needs-validation p-3" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Nom</label>
                            <input type="text" name="nom" class="form-control" id="validationCustom02"
                                placeholder="Entrez le nom du departement" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Code</label>
                            <input type="text" name="code" class="form-control" id="validationCustom02"
                                placeholder="Entrez le code" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn mb-2 btn-green-1">Valider</button>

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
                url: "{{url('delete/departement')}}/" + id,
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

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
{{-- correspondant table --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des correspondants</h5>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group col-auto mr-auto">
                                <button type="button" class="btn mb-2 btn-green-1" data-toggle="modal"
                                    data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>
                                @if (Auth::user()->role === "admin")
                                <a href="{{ route('corbeille.correspondant') }}" role="button"
                                class="btn mb-2 btn-danger text-white"> <i class="fe fe-trash-2"></i> Corbeille {{
                                $corbeille }}</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Fonction</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($rows as $row)
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->prenom }}</td>
                            <td>{{ $row->nom }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->fonction }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('edit.correspondant',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- Fin correspondant -->
</div>

{{-- modal forme Nouveau correspondant --}}

        <!-- Modal -->
        <div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verticalModalTitle">Nouveau Correspondant</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('new.correspondant') }}" class="needs-validation p-3"
                            novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Nom</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="nom"
                                        placeholder="Entrez le nom du correspondant" required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Prénom</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="prenom"
                                        placeholder="Entrez le prenom du correspondant" required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Email (Facultatif)</label>
                                    <input type="email" class="form-control" id="validationCustom02" name="email"
                                        placeholder="Entrez email du correspondant">
                                    <div class="valid-feedback"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Telephone</label>
                                    <input  type="text" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="validationCustom02" name="phone"
                                        placeholder="Entrez le contact du correspondant">
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="simple-select2">Type</label>
                                    <select class="form-control select2" name="type" id="simple-select2" required>
                                        <option selected disabled value="">Selectionner</option>
                                        <option value="externe">externe</option>
                                        <option value="interne">interne</option>
                                    </select>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Fonction/Profession</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="fonction"
                                        placeholder="Entrez la fonction du correspondant">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Ce champ est obligatoire.</div>

                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn mb-2 btn-secondary"
                                    data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn mb-2 btn-green-1">Valider</button>
                            </div>
                        </form>
                    </div>
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
                url: "{{url('delete/correspondant')}}/" + id,
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

@extends('layouts.app')
@section('content')

{{-- journal table --}}
<div class="row">
    <div class="col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Journalisation Dashboard</h5>
                    <form class="form">
                        <div class="form-row">
                            <div class="col-auto mr-auto form-group">
                                <a href="{{ route('corbeille.journal') }}" role="button"
                                class="btn mb-2 btn-danger text-white ml-2"> <i class="fe fe-trash-2"></i> Corbeille {{
                                $corbeille }}</a>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Libelle</th>
                            <th>Nom</th>
                            <th>Email</th>
                            {{-- <th>Poste</th> --}}
                            <th>Departement</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->libelle }}</td>
                            @isset($row->user)
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->user->email }}</td>
                            {{-- <td>{{ $row->user->poste->nom }}</td> --}}
                            <td>{{ $row->user->departement->nom }}</td>
                            <td>{{ $row->user->role }}</td>
                            <td>{{ $row->created_at->format('d/m/Y H:m:s') }}</td>
                            <td>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-trash"></i></button>
                            </td>
                            @endisset
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- Fin journal -->
</div>
</div>
<Script>
    function deleteConfirmation(id) {
    swal.fire({
        title: "Supprimer?",
        icon: 'question',
        text: "Etes vous sur de vouloir supprimer cet utilisateur!",
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
                url: "{{url('delete/journal')}}/" + id,
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

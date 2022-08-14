@extends('layouts.app')
@section('content')

{{-- corbeille table --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Nature Corbeille Dashboard</h5>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group col-auto mr-auto">
                                @if (count($rows) > 0)
                                <button type="button" onclick="restore_all()" class="btn mb-2 btn-danger text-white"> <i
                                        class="fe fe-refresh-ccw"></i>Tout restaurer</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Courrier N°</th>
                            <th>Date arriver</th>
                            <th>Objet</th>
                            <th>Departement</th>
                            <th>Crée</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->courrier->numero }}</td>
                            <td>{{ $row->courrier->date_arriver }}</td>
                            <td>{{ $row->courrier->objet }}</td>
                            <td>{{ $row->departement->nom }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('edit.diffusion',['id'=> $row->id]) }}" role="button"
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
</div> <!-- Fin correspondant -->
</div>
</div>
<script>
    // restaurer un seul element
    function deleteConfirmation(id) {
    swal.fire({
        title: "Restaurer?",
        icon: 'question',
        text: "Etes vous sur de vouloir restaurer cet element!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Oui, Restaurer!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: !0
    }).then(function (e) {

        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "{{url('restore/diffusion')}}/" + id,
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

     // restaurer un tous les element
     function restore_all() {
    swal.fire({
        title: "Restaurer?",
        icon: 'question',
        text: "Etes vous sur de vouloir restaurer tous les elements!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Oui, Restaurer!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: !0
    }).then(function (e) {

        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "{{url('restore/all/diffusion')}}",
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
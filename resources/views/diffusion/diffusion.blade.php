@extends('layouts.app')
@section('content')

{{-- Diffusion table --}}
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des diffusions</h5>
                    <div class="btn-group" role="group" aria-label="Basic example">

                        @if (Auth::user()->role === "admin")
                        <a href="{{ route('corbeille.diffusion') }}" role="button"
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
                            <td>{{  date('d/m/Y',strtotime($row->courrier->date_arriver)) }}</td>
                            <td>{{ $row->courrier->objet }}</td>
                            <td>{{ $row->departement->nom }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if (Auth::user()->role === "admin")
                                <a href="{{ route('edit.diffusion',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-trash"></i></button>
                                @endif
                                @if (Auth::user()->role === "superuser" and Auth::user()->id === $row->user->id)
                                <a href="{{ route('edit.diffusion',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->

</div> <!-- end traitement -->


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
                url: "{{url('delete/diffusion')}}/" + id,
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

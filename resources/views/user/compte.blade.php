@extends('layouts.app')
@section('content')
{{-- utilisateurs table --}}
<div class="row">
    <div class="col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des utilisateurs</h5>

                    <form class="form">
                        <div class="form-row">
                            <div class="col-auto mr-auto form-group">
                                <a role="button" href="{{ route('register.user') }}"
                                    class="mb-2 border-0 btn btn-green-1">
                                    <i class="fe fe-plus"></i> Nouveau</a>
                                    @if (Auth::user()->role === "admin")
                                    <a href="{{ route('corbeille.user') }}" role="button"
                                    class="btn mb-2 btn-danger text-white ml-2"> <i class="fe fe-trash-2"></i> Corbeille
                                    {{ $corbeille }}</a>
                                    @endif

                            </div>
                        </div>
                    </form>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Poste</th>
                            <th>Departement</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)

                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>
                                <div class="avatar">
                                    <img src="{{ asset('assets/avatars/face-1.jpg') }}" class="img-fluid rounded-circle"
                                        alt="photo">
                                </div>
                                {{ $row->name }}
                            </td>


                            <td>{{ $row->email }}</td>

                            <td>{{ $row->poste }}</td>
                            <td>{{ $row->departement->nom }}</td>
                            <td>{{ $row->role }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            @if ($row->etat == 1)
                            <td><span class="mr-1 dot dot-md bg-success"></span> En ligne</td>
                            @else
                            <td><span class="mr-1 dot dot-md bg-danger"></span> Pas en ligne</td>
                            @endif
                            <td>
                                <a href="{{ route('show.user',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>

                                <a href="{{ route('edit.user',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-edit"></i></a>
                                @if (Auth::user()->role === "admin")
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
</div> <!-- Fin compte -->
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
                url: "{{url('delete/user')}}/" + id,
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
{{-- @section('scroll')
scrollX: true,
@endsection --}}

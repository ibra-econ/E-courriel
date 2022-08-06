@extends('layouts.app')
@section('content')

{{-- departement table --}}
<div class="row">
    <div class="col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Document Dashboard</h5>
                    <form class="form">
                        <div class="form-row">
                            <div class="col-auto mr-auto form-group">
                                <a href="{{ route('corbeille.document') }}" role="button"
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
                            <th>Courrier N°</th>
                            <th>Date arriver</th>
                            <th>Taille</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->libelle }}</td>
                            <td>{{ $row->courrier->numero }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->courrier->date_arriver)) }}</td>
                            <td>{{ Storage::size($row->chemin) }} Ko</td>
                            <td>{{ $row->created_at->format('d/m/Y H:m:s') }}</td>
                            <td>
                                <a target="_blank" href="{{ route('show.document',['id'=> $row->id]) }}" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
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
</div>
<Script>
    function deleteConfirmation(id) {
    swal.fire({
        title: "Supprimer?",
        icon: 'question',
        text: "Etes vous sur de vouloir supprimer ce document!",
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
                url: "{{url('delete/document')}}/" + id,
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

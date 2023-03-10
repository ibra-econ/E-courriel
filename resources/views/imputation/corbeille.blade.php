@extends('layouts.app')
@section('content')

{{-- corbeille table --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Corbeille Imputation</h5>
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
                            <th>Réference</th>
                            <th>Numero</th>
                            <th>Objet</th>
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
                            <td>{{ $row->courrier->reference }}</td>
                            <td>{{ $row->courrier->numero }}</td>
                            <td>{{ $row->courrier->objet }}</td>
                            <td>{{ $row->courrier->correspondant->nom.' '.$row->courrier->correspondant->prenom }}</td>
                            <td>{{ $row->departement->nom }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->courrier->date_arriver)) }}</td>
                            <td>{{ $row->fin_traitement }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-rotate-ccw"></i></button>
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
                url: "{{url('restore/imputation')}}/" + id,
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
                url: "{{url('restore/all/imputation')}}",
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

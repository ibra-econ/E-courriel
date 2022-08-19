@extends('layouts.app')
@section('content')
{{-- courrier table --}}
<div class="row">
    <div class="my-4 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des courrier arriver</h5>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Réference</th>
                            <th>Numero</th>
                            <th>Nature</th>
                            <th>Type</th>
                            <th>Priorité</th>
                            <th>correspondant</th>

                            <th>Date arrivée</th>
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
                            <td>{{ $row->nature->nom }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->priorite }}</td>
                            <td>{{ $row->correspondant->prenom.' '.$row->correspondant->nom }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->date_arriver)) }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('suivie.courrier',['id'=> $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1  mt-1"><i class="fe fe-eye"></i></a>
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
@endsection
@section('scroll')
scrollX: true,
@endsection

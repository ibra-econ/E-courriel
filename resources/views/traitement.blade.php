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
    {{-- courrier traitement table --}}
<div class="row">
    <div class="my-2 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Courrier traitement Dashboard</h5>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Réference</th>
                            <th>User</th>
                            <th>Nature</th>
                            <th>Type</th>
                            <th>Priorité</th>
                            <th>Emetteur</th>
                            <th>Destinateur</th>
                            <th>Etat</th>
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
                            <td> {{ $row->user->name }}</td>
                            <td>{{ $row->nature->nom }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->priorite }}</td>
                            <td>{{ $row->emetteur }}</td>
                            <td>{{ $row->destinateur }}</td>
                            <td>{{ $row->etat }}</td>
                            <td>{{  date('d/m/Y',strtotime($row->date_arriver)) }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-download"></i></a>
                                <a href="{{ route('edit.traitement', ['id' => $row->id]) }}" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-settings"></i></a>
                                {{-- <a href="{{ route('edit.courrier',['id'=> $row->id]) }}" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- end courrier -->
@endsection

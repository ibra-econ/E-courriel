@extends('layouts.app')
@section('content')
{{-- courrier archive table --}}
<div class="row">
    <div class="my-4 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Courrier archive Dashboard</h5>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="mb-2 border-0 btn btn-green-1" data-toggle="modal"
                            data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>

                    </div>
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
                            <th>Fichier</th>
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
                            <td><i class="fe fe-folder"></i></td>
                            <td><span class="badge badge-pill badge-success text-white">{{ $row->etat }}</span></td>
                            <td>{{ date('d/m/Y',strtotime($row->date_arriver)) }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('show.courrier',['id'=> $row->id]) }}" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-trash"></i></button>
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
@endsection

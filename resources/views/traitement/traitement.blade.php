@extends('layouts.app')
@section('content')

{{-- courrier imputation table --}}
<div class="row">
    <div class="my-2 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Listes des traitements</h5>

                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Poste</th>
                            <th>Réference</th>
                            <th>Numero</th>
                            <th>Type</th>
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
                            <td>{{ $row->user->poste }}</td>
                            <td>{{ $row->courrier->reference }}</td>
                            <td>{{ $row->courrier->numero }}</td>
                            <td>{{ $row->courrier->type }}</td>
                            <td>{{ $row->courrier->correspondant->nom.' '.$row->courrier->correspondant->prenom }}</td>
                            <td>{{ $row->departement->nom }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->courrier->date_arriver)) }}</td>
                            <td>{{ $row->fin_traitement }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if (Auth::user()->isAdmin() || Auth::user()->isSuperuser())
                                <a href="{{ route('edit.traitement', ['id' => $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1 mt-1"><i class="fe fe-settings"></i></a>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- end courrier imputation -->
@endsection
@section('scroll')
scrollX: true,
@endsection

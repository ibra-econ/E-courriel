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
{{-- courrier imputation table --}}
<div class="row">
    <div class="my-2 col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Courrier Imputation Dashboard</h5>
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
                            <td>{{ date('d/m/Y',strtotime($row->date_arriver)) }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i
                                        class="fe fe-download"></i></a>
                                <a href="{{ route('edit.traitement', ['id' => $row->id]) }}" role="button"
                                    class="btn btn-sm btn-green-1"><i class="fe fe-settings"></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- end courrier imputation -->


<div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de nouvelle imputation</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="p-3 needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Courrier</label>
                            <select class="custom-select" name="user" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner un courrier</option>
                                @forelse ($rows as $row)
                                <option value="{{ $row->id }}">{{ $row->reference.'-'.$row->objet }}</option>
                                @empty
                                <option>Aucun courrier</option>
                                @endforelse
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Deepartement/Service traitement</label>
                            <select class="custom-select" name="" id="validationCustom04" required>
                                <option selected disabled value="">Selectionner</option>
                                @forelse ($departement as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @empty
                                <option>Aucun courrier</option>
                                @endforelse
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02">Date imputation</label>
                                <input type="date" name="date" class="form-control" id="validationCustom02"
                                    placeholder="Entrez le nom de la nature" required>
                                <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02">Delai</label>
                                <input type="date" name="nom" class="form-control" id="validationCustom02"
                                    placeholder="Entrez le nom de la nature" required>
                                <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <p>ANNOTATION</p>
                        </div>
                        <div class="row mt-5">
                            @forelse ($annotation as $row)
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" value="{{ $row->id }}"
                                        id="{{ $row->id }}">
                                    <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                                </div>
                            </div>
                            @empty
                            <h3 class="text-center">Aucune annotation</h3>
                            @endforelse
                        </div>

                        <div class="text-center">
                            <p>Imputation</p>
                        </div>
                        <div class="row mt-5">
                            @forelse ($departement as $row)
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" value="{{ $row->id }}"
                                        id="{{ $row->id }}">
                                    <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                                </div>
                            </div>
                            @empty
                            <h3 class="text-center">Aucune annotation</h3>
                            @endforelse
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="mb-2 btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="mb-2 btn btn-success">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

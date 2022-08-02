@extends('layouts.app')
@section('content')

{{-- departement table --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Correspondant Dashboard</h5>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group col-auto mr-auto">
                                <button type="button" class="btn mb-2 btn-green-1" data-toggle="modal"
                                    data-target="#verticalModal"> <i class="fe fe-plus"></i> Nouveau</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Profession</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2370</td>
                            <td>
                                <div class="progress progress-sm" style="height:3px">
                                    <div class="progress-bar" role="progressbar" style="width: 87%" aria-valuenow="87"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td>Barry Bright</td>
                            <td>Donec Corporation</td>
                            <td>662-5410 Eu Ave</td>
                            <td>662-5410 Eu Ave</td>
                            <td>Jun 22, 2020</td>
                            <td>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-eye"></i></a>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></a>
                                <a href="" role="button" class="btn btn-sm btn-green-1"><i class="fe fe-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- Bordered table -->
</div> <!-- Fin Département -->
</div>

{{-- modal forme Nouveau Département --}}
<div class="card shadow">
    <div class="card-body">
        <!-- Modal -->
        <div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verticalModalTitle">Nouveau Département</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation p-3" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Nom</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="Otto"
                                        placeholder="Entrez le nom du departement" required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Imputation</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="Otto"
                                        placeholder="Entrez l'imputation" required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Responsable</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="Otto"
                                        placeholder="Entrez le nom du responsable" required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Hiérarchie</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="Otto"
                                        placeholder="Entrez la hiérarchie du responsable" required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Nom d'utisateur</label>
                                    <select class="custom-select" id="validationCustom04" required>
                                        <option selected disabled value="">Selectionner</option>
                                        <option>Courrier entrant</option>
                                        <option>Courrier sortant</option>
                                    </select>
                                    <div class="invalid-feedback"> Please select a valid state. </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn mb-2 btn-secondary"
                                    data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn mb-2 btn-success">Valider</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection

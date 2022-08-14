@extends('layouts.app')
@section('content')

<h2 class="h3 mb-4 page-title">Profile</h2>
<div class="card shadow-sm p-4">
    <div class="text-right">
        @if (Auth::user()->isAdmin())
        <a class="btn btn-green-1" href="{{ route('edit.user',['id'=> $user->id]) }}" role="button">Modifier <i
                class="fe fe-edit"></i> </a>
        @endif
    </div>

    <div class="row mt-5 align-items-center">
        <div class="col-md-3 text-center mb-5">
            <div class="avatar avatar-xl">
                <img src="{{ asset('assets/images/logo_icon.png') }}" alt="logo" class="avatar-img rounded">
                {{-- <img src="{{ Storage::url($user->logo) }}" alt="logo" class="avatar-img rounded"> --}}
            </div>
        </div>
        <div class="col">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <hr>
                    <h5 class="mb-0"> <i style="color: #00704D;" class="fe fe-mail"></i> Email: {{ $user->email }}</h5>
                    <h5 class="mb-0"><i style="color: #00704D;"  class="fe fe-airplay"></i> Poste: {{ $user->poste }}</h5>
                    <h5 class="mb-0"><i style="color: #00704D;"  class="fe fe-layers"></i> Deartement: {{ $user->departement->nom }}</h5>
                    <h5 class="mb-0"><i style="color: #00704D;"  class="fe fe-shield"></i> Role: {{ $user->role }}</h5>
                    <h5 class="mb-0"> <i style="color: #00704D;"  class="fe fe-inbox"></i> Total courrier: {{ $user->courriers_count }}</h5>
                    <h5 class="mb-0"> <i style="color: #00704D;"  class="fe fe-share-2"></i> Total imputations: {{ $user->imputations_count }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- star statisitique --}}

{{-- journqal table --}}
@if (Auth::user()->isAdmin())
<div class="row">
    <div class="col-md-12">
        <div class="shadow card">
            <div class="card-body">
                <div class="toolbar">
                    <h5 class="card-title">Journalisation</h5>
                </div>
                <table class="table datatables" id="dataTable-1">
                    <thead class="thead-green">
                        <tr>
                            <th>ID</th>
                            <th>Libelle</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Poste</th>
                            <th>Departement</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->journals as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->libelle }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->user->email }}</td>
                            <td>{{ $row->user->poste }}</td>
                            <td>{{ $row->user->departement->nom }}</td>
                            <td>{{ $row->user->role }}</td>
                            <td>{{ $row->created_at->format('d/m/Y H:m:s') }}</td>
                            <td>
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
</div> <!-- Fin journal -->
@endif
{{-- end statisitique --}}

@endsection

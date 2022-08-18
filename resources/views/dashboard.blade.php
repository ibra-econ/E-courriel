@extends('layouts.app')
@section('content')


{{-- star statisitique --}}
<div class="row">

    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <a class="nav-link" href="{{ route('Depart') }}">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-trending-up text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Départ</p>
                            <span class="mb-0 text-white h3">{{ $depart }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-2">
            <div class="card-body">
                <a href="{{ route('Arriver') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-trending-down text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Arrivées</p>
                            <span class="mb-0 text-white h3">{{ $arriver }}</span>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-3">
            <div class="card-body">
                <a href="{{ route('Interne') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-repeat text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total interne</p>
                            <span class="mb-0 text-white h3">{{ $interne }}</span>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div> <!-- end section -->

{{-- si user admin --}}
@if (Auth::user()->role === "admin")
<div class="row">
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <a href="{{ route('Correspondant') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-user-check fe-trending-up text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Correspondant</p>
                            <span class="mb-0 text-white h3">{{ $correspondant }}</span>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-2">
            <div class="card-body">
                <a href="{{ route('Departement') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-layers text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Departement</p>
                            <span class="mb-0 text-white h3">{{ $departement }}</span>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-3">
            <div class="card-body">
                <a href="{{ route('Compte') }}" class="nav-link"></a>
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-users text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total utilisateurs</p>
                        <span class="mb-0 text-white h3">{{ $user }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end section -->
{{-- end statisitique --}}
@endif
<div class="row my-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="chart-box">
                    <div id="columnChart"></div>
                </div>
            </div>
        </div>

    </div> <!-- .col -->
    {{-- Notifications --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>

            </div>
            <div class="card-body">
                <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">

                            @forelse (Auth::user()->notifications as $row)
                            <div class="col-4">
                                <span class="fe fe-mail fe-24"></span>
                            </div>
                            <div class="col-8">
                                <small><strong>{{ $row->data['title'] }}</strong></small> <br>
                                <small class="badge badge-pill badge-light text-muted">{{
                                    $row->created_at->diffForHumans() }}</small>
                            </div>
                            <hr>
                            @empty
                            <h3>Vous avez aucune notification</h3>
                            @endforelse

                        </div>
                    </div>
                </div> <!-- / .list-group -->
            </div>
        </div>
    </div>
    {{-- fin Notifications --}}
</div> <!-- end section -->

@endsection
@section('chart')
<script src="{{ asset('assets/chart-script.js') }}"></script>
@endsection

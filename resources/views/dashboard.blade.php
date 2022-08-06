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
                <a class="nav-link" href="{{ route('Compte') }}"></a>
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-bell text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Notification</p>
                        <span class="mb-0 text-white h3">{{ $user }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end section -->

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

@endsection

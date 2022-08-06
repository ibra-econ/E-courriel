@extends('layouts.app')
@section('content')
<h2 class="h3 mb-4 page-title">Information</h2>
<div class="text-right">
    <a class="btn btn-green-1" href="{{ route('edit.config',['id'=> $rows->id]) }}" role="button">Modifier <i
            class="fe fe-edit"></i> </a>
</div>
<div class="row mt-5 align-items-center">
    <div class="col-md-3 text-center mb-5">
        <div class="avatar avatar-xl">
            <img src="{{ asset('assets/images/logo_icon.png') }}" alt="logo" class="avatar-img rounded">
            {{-- <img src="{{ Storage::url($rows->logo) }}" alt="logo" class="avatar-img rounded"> --}}
        </div>
    </div>
    <div class="col">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="mb-1">{{ $rows->nom }}</h4>
                <p class="mb-0">{{ $rows->email }}</p>
                <p class="mb-0">{{ $rows->contact }}</p>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">
                <p> {{ $rows->description }}</p>
            </div>

        </div>
    </div>
</div>
{{-- star statisitique --}}
<div class="row my-4">
    <div class="mb-4 col-md-6 col-xl-3">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
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
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-3">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
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
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-3">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-mail text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Courrier</p>
                        <span class="mb-0 text-white h3">{{ $courrier }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-3">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
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

</div> <!-- /.col-12 -->
@endsection

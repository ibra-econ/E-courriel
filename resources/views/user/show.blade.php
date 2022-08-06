@extends('layouts.app')
@section('content')
<h2 class="h3 mb-4 page-title">Profile</h2>
<div class="text-right">
    <a class="btn btn-green-1" href="{{ route('edit.user',['id'=> $user->id]) }}" role="button">Modifier <i
            class="fe fe-edit"></i> </a>
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
                <h5 class="mb-0">Email: {{ $user->email }}</h5>
                @isset( $user->poste)
                <h5 class="mb-0">Poste: {{ $user->poste->nom }}</h5>
                @endisset
                <h5 class="mb-0">Deartement: {{ $user->departement->nom }}</h5>
                <h5 class="mb-0">Role: {{ $user->role }}</h5>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">
                <p> {{ $user->description }}</p>
            </div>

        </div>
    </div>
</div>
{{-- star statisitique --}}
<div class="row my-4">
    <div class="col-md-6 mt-5">
    <div class="mb-4 col-md-12 col-xl-12">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-mail text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Courrier</p>
                        <span class="mb-0 text-white h3">{{ $user->courriers_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-12 col-xl-12">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-share-2 text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Imputations</p>
                        <span class="mb-0 text-white h3">{{ $user->imputations_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <h5 class="mb-0">Activiter Recente</h5>
    <table class="table border bg-white">
      <thead>
        <tr>
          <th>Appareil</th>
          <th>libelle</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
       @foreach ($user->journals as $row)
       <tr>
        <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - Windows 10</th>
        <td>{{ $row->libelle }}</td>
        <td>{{ $row->created_at->format('d/m/Y') }}</td>
      </tr>
       @endforeach
      </tbody>
    </table>
</div>
</div> <!-- end section -->
{{-- end statisitique --}}



</div> <!-- /.col-12 -->
@endsection

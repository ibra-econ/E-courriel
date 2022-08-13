@extends('layouts.app')
@section('content')

<h2 class="h3 mb-4 page-title">Profile</h2>
<div class="card shadow-sm p-4">
    <div class="text-right">
        @if (Auth::user()->role === "admin")
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
                    <h5 class="mb-0"><i style="color: #00704D;"  class="fe fe-airplay"></i> Poste: {{ $user->poste->nom }}</h5>
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

</div> <!-- end section -->
{{-- end statisitique --}}

</div> <!-- /.col-12 -->
@endsection

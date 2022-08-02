@extends('layouts.app')
@section('content')
<div class="col-12">
    <h2 class="h3 mb-4 page-title">Profile</h2>
    <div class="row mt-5 align-items-center">
      <div class="col-md-3 text-center mb-5">
        <div class="avatar avatar-xl">
          <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
        </div>
      </div>
      <div class="col">
        <div class="row align-items-center">
          <div class="col-md-7">
            <h4 class="mb-1">Brown, Asher</h4>
            <p class="small mb-3">Email: {{ $rows->email }}</p>
            <p class="small mb-3">Poste: {{ $rows->poste }}</p>
            <p class="small mb-3">Privilege: {{ $rows->role }}</p>
            <p class="small mb-3">Statuts: <span class="dot dot-md bg-success mr-1"></span> En ligne</p>
          </div>
        </div>
      </div>
    </div>

@endsection

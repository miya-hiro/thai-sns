@extends('app')

@section('title', 'プロフィール更新')

@include('nav')

@section('content')
<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          {{ $user->name }} のプロフィール編集
        </a>
      </h2>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{ route('users.update', [ $user->name]) }}" class="prof-formWrap">
      @csrf
      <!-- @method('PATCH') -->
      @include('users.form')
      <button type="submit" class="btn blue-gradient btn-block">更新する</button>
    </form>


  </div>

</div>@endsection
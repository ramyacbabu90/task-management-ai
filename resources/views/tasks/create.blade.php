@extends('layouts.app')

@section('page-title', 'Create Task')

@section('content')

<form action="{{ route('tasks.store') }}"
      method="POST">

    @csrf

    @include('tasks.partials.form')

</form>

@endsection
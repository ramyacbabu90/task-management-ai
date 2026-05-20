@extends('layouts.app')

@section('page-title', 'Edit Task')

@section('content')

<form action="{{ route('tasks.update', $task->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    @include('tasks.partials.form')

</form>

@endsection
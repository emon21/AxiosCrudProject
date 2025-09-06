@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Category Details</h2>

    <p><b>ID:</b> {{ $cat->id }}</p>
    <p><b>Name:</b> {{ $cat->name }}</p>

    <a href="{{ route('get-all-category') }}">Back to List</a>
</div>
@endsection
@extends('layouts.app')

@section('content')
    <h1>All expenses</h1>
    @foreach ($expenses as $expense)
        <p> {{$expense["amount"]}} : {{$expense[ "description" ]}} : {{$expense[ "vendor" ]}} : {{$expense[ "type" ][ "name" ]}}</p>
    @endforeach
@endsection
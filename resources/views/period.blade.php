@extends('layouts.app')

@section('content')
    <h1 class="title">Welcome</h1>
    <form action="{{ action('PeriodController@index') }}" method="POST">
        @csrf
        <input type="hidden" name="preset" value="week">
        <button type="submit">Week<button>
    </form>
@endsection

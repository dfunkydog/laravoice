@extends('layouts.app') 
@section('content')
<h1 class="title">Welcome</h1>
<form action="{{ action('PeriodController@index') }}" method="POST">
    @csrf
    <input type="hidden" name="preset" value="7days" />
    <button type="submit">Last 7 Days</button>
</form>
<form action="{{ action('PeriodController@index') }}" method="POST" /> @csrf
<input type="hidden" name="preset" value="1mth">
<button type="submit">Last 30 Days</button>
</form>
<form action="{{ action('PeriodController@index') }}" method="POST" /> @csrf
<input type="hidden" name="preset" value="3mths">
<button type="submit">Last 90 Days</button>
</form>
<form action="{{ action('PeriodController@index') }}" method="POST" /> @csrf
<input type="hidden" name="preset" value="month">
<button type="submit">This month</button>
</form>
<form action="{{ action('PeriodController@index') }}" method="POST" /> @csrf
<input type="hidden" name="preset" value="week">
<button type="submit">This week</button>
</form>
@endsection
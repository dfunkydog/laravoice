@extends('layouts.app')

@section('content')
    <h1>Total expenditure: £{{$expenses->sum('amount') }} </h1>
    @foreach ($expenses as $expense)
        <p> <a href="{{action('ExpenseController@show', ['id' => $expense->id])}}"><strong>{{ $expense->paid_on }}: </strong>{{$expense->amount}} : {{$expense->description}} : {{$expense->vendor}} : {{$expense->type->name}}</a></p>
    @endforeach
    <a href={{ action('ExpenseController@create') }}>NEW</a>
@endsection

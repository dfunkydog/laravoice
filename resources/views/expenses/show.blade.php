@extends('layouts.app')

@section('content')
<h1><a href={{ action('ExpenseController@index') }}>All expenses</a></h1>
@if ($errors->any())
    {{$error->all()}}
@endif
 <a href="{{action('ExpenseController@edit', ['expense' => $expense->id])}}">EDIT</a>
<form action={{ action('ExpenseController@destroy', ['id'=>$expense->id]) }} method="POST" >
    @csrf
    @method('DELETE')
<button type="submit">Delete</button>
</form>
 <p>created by:{{ $expense->user->name}}<p>
 <p><strong>{{$expense->paid_on}}</strong> {{$expense->amount}} : {{$expense->description}} : {{$expense->vendor}} : {{$expense->type->name}}</p>
@endsection

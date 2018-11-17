@extends('layouts.app') 
@section('content')
<section class="section">
    <h1><a href={{ action( 'ExpenseController@index') }}>All expenses</a></h1>
    <a href="{{URL::previous()}}">Back</a> @if ($errors->any()) {{$error->all()}} @endif
    <div class="expense-details ">
        <a class="btn " href="{{action( 'ExpenseController@edit', [ 'expense'=> $expense->id])}}">EDIT</a>
        <h3 class="expense-detail__title">{{$expense->vendor}}</h3>
        <p>£{{$expense->amount}}</p>
        <p>{{$expense->type->name}}</p>
        <p>{{$expense->description}} </p>
        <p><strong>{{$expense->paid_on}}</strong> - {{ $expense->user->name}}</p>
        <form action={{ action( 'ExpenseController@destroy', [ 'id'=>$expense->id]) }} method="POST" > @csrf @method('DELETE')
            <button class="btn btn--incognito" type="submit">Delete</button>
        </form>
    </div>
</section>
@endsection
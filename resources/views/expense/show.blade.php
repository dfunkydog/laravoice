@extends('layouts.app') 
@section('content')
<section class="section">
    <h1><a href={{ action( 'ExpenseController@index') }}>All expenses</a></h1>
    <a href="{{URL::previous()}}">Back</a> @if ($errors->any()) {{$error->all()}} @endif
    <div class="expense-details ">
        <a class="btn " href="{{action( 'ExpenseController@edit', [ 'expense'=> $expense->id])}}">EDIT</a>
        <h3 href="{{ route('category', ['id'=>1]) }}">{{$expense->type->name}} - £{{$expense->amount}}
        </h3>
        <p class="expense-detail__title"><a href="{{ route('vendor.show', ['id'=>$expense->vendor->id]) }}">{{$expense->vendor->name}}</a></br>
            {{$expense->description}} </p>
        <form action={{ action( 'ExpenseController@destroy', [ 'id'=>$expense->id]) }} method="POST" > @csrf @method('DELETE')
            <button class="btn btn--incognito" type="submit">DELETE</button>
        </form>
        <div class="expense-details__footer">{{$expense->paid_on}} {{ $expense->user->name}}</div>
    </div>
</section>
    @include('layouts.add-new')
@endsection
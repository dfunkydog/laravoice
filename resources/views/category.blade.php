@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total spent on {{$category->name}} £{{$expenses->sum('amount') }} </h1>
    <a href={{ action( 'CategoryController@create') }}>NEW</a>
    <ul class="catlist">
        @foreach ($expenses as $expense)
        <li class="catlist__item">
            <a href="{{action('ExpenseController@show', ['id' => $expense->id])}}">{{$expense->description}}
            <div class="catlist__count">
                {{$expense->vendor}}
                <span> <strong>{{ $expense->paid_on }}: </strong></span>
            </div>
            <div class="catlist__amount pill">
                {{$expense->amount}}
            </div>
            </a>
        </li>
        @endforeach
    </ul>
</section>
@endsection
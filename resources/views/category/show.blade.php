@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total spent on {{$category->name}} £{{$expenses->sum('amount') }} </h1>
    <ul class="catlist">
        @foreach ($expenses as $expense)
        <li>
            <a class="catlist__item" href="{{action('ExpenseController@show', ['id' => $expense->id])}}">{{strtoupper($expense->vendor)}}
                <div class="catlist__count">
                    {{$expense->description}}
                </div>
                <div class="catlist__amount pill">
                    {{$expense->amount}}
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    <a href={{ action( 'CategoryController@create') }}>A</a>dd a new category
</section>
@endsection
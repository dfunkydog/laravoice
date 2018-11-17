@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total expenditure:for this month £{{$totalExpenses}} </h1>
    <a href={{ action( 'ExpenseController@create') }}>NEW</a> @if ($vendors->count() > 0)
    <ul class="catlist">
        @foreach ($vendors as $vendor)
        <li>
            <a class="catlist__item" href="{{ action('CategoryController@show', ['vendor'=>$vendor]) }}">
            <strong>{{strtoupper($vendor->vendor)}}</strong>
            <div class="catlist__count">{{$vendor->count}} items</div>
            <div class="catlist__amount pill">
                {{$vendor->total}}
            </div>
        </a>
        </li>
        @endforeach
    </ul>
    @else No expenses yet @endif
</section>
@endsection
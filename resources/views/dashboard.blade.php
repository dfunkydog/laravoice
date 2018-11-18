@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total expenditure for this month £{{$totalExpenses}} </h1>
    @if ($categories->count() > 0)
    <ul class="catlist">
        @foreach ($categories as $category)
        <li>
            <a class="catlist__item" href="{{ action('CategoryController@show', ['category'=>$category->type->id]) }}">
            <strong>{{strtoupper($category->type->name)}}</strong>
            <div class="catlist__count">{{$category->count}} items</div>
            <div class="catlist__amount pill">
               <sup>£</sup>{{$category->total}}
            </div>
        </a>
        </li>
        @endforeach
    </ul>
    @else No expenses yet @endif
</section>
    @include('layouts.add-new')
@endsection
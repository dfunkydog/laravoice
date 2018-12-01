@extends('layouts.app') 
@section('content')
<section class="section">
    @if ($categories->count() > 0)
    <h1>Total expenditure for this month £{{$totalExpenses}} </h1>
    <ul class="catlist">
        @foreach ($categories as $category)
        <li>
            <a class="catlist__item" href="{{ action('CategoryController@show', ['category'=>$category->type->id]) }}" style="background-size: {{ $category->total *100 /$categories->max('total')  }}% {{config( 'view.depth') }} ">
            <strong>{{strtoupper($category->type->name)}}</strong>
            <div class="catlist__count">{{$category->count}} items</div>
            <div class="catlist__amount pill">
               <sup>£</sup>{{$category->total}}
            </div>
        </a>
        </li>
        @endforeach
    </ul>
    @else
    <h1>No expenses recorded for this month</h1>
    @endif
</section>
    @include('layouts.add-new')
@endsection
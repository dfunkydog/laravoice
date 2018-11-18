@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total expenditure:for this month £{{$totalExpenses}} </h1>
    @if ($vendors->count() > 0)
    <ul class="catlist">
        @foreach ($vendors as $vendor)
        <li>
            <a class="catlist__item" href="{{ action('VendorController@show', ['vendor'=>$vendor->vendor->id]) }}">
            <strong>{{strtoupper($vendor->vendor->name)}}</strong>
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
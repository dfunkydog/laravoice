@extends('layouts.app')
@section('content')
<section class="section">
    <h1>Recurring Expenses</h1>
    <ul class="catlist">
        @foreach ($items as $item)
        <li>
            <a class="catlist__item">
                <span>Day of month : <strong>{{$item->day_of_month}}</strong></span>
                <div class="catlist__count"><strong>{{$item->expense->vendor->name}}</strong>: {{$item->expense->description}} items</div>
                <div class="catlist__amount pill">
                    <sup>£</sup> {{$item->expense->amount}}
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</section>
@endsection
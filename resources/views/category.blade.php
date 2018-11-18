@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total spent on {{$category->name}} £{{$expenses->sum('amount') }} </h1>
    <ul class="catlist">
        @foreach ($expenses as $expense)
        <li class="catlist__item">
            {{$expense->vendor}}
            <div class="catlist__count">
                {{$expense->vendor}}
                <span> <strong>{{ $expense->paid_on }}: </strong></span>
            </div>
            <div class="catlist__amount pill">
                {{$expense->amount}}
            </div>
        </li>
        @endforeach
    </ul>
</section>
    @include('layouts.add-new')
@endsection
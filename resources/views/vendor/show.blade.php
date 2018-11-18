@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total spent at {{$vendor->name}} £{{$expenses->sum('amount') }} </h1>
    <ul class="catlist">
        @foreach ($expenses as $expense)
        <li>
            <a class="catlist__item" href="{{action('ExpenseController@show', ['id' => $expense->id])}}"><strong>{{strtoupper($expense->type->name)}}</strong>
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
</section>
    @include('layouts.add-new')
@endsection
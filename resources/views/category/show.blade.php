@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total spent on {{$category->name}} {{ session('period_label') ?: 'this month'}} £{{$expenses->sum('amount') }} </h1>
    <ul class="catlist">
        @foreach ($expenses as $expense)
        <li>
            <a class="catlist__item" href="{{action('ExpenseController@show', ['expense' => $expense->id])}}" style="background-size: {{ $expense->amount *100 /$expenses->max('amount')  }}% {{config( 'view.depth') }} ">
                <strong>{{strtoupper($expense->vendor->name)}}</strong>
                <div class="catlist__count ">
                    {{$expense->description}}
                </div>
                <div class="catlist__amount pill ">
                {!! money($expense->amount) !!}
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</section>
    @include('layouts.add-new')
@endsection
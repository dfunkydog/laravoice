@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total spent at {{$vendor->name}} {{ session('period_label') ?: 'this month'}} {!! money($expenses->sum('amount')) !!}
    </h1>
    <ul class="catlist">
        @foreach ($expenses as $expense)
        <li>
            <a class="catlist__item" href="{{action('ExpenseController@show', ['expense' => $expense->id])}}" style="background-size: {{ $expense->amount *100 /$expenses->max('amount')  }}% {{config( 'view.depth') }} "><strong>{{strtoupper($expense->type->name)}}</strong>
                <div class="catlist__count">
                    {{$expense->description}} <span class="text-transluscent">{{$expense->paid_on}}</span>
                </div>
                <div class="catlist__amount pill">
                    {!! money($expense->amount) !!}
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</section>
    @include('layouts.add-new')
@endsection
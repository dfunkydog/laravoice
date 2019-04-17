@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Scheduled Expenses</h1>
    <ul class="catlist">
        @foreach ($items as $item)
        <li>
            <a class="catlist__item">
                <span>{{$item->pattern->pattern}} on:<strong>
                    @if ($item->pattern->id==1)
                    {{
                        str_ordinal($item->scheduled_day)
                    }}
                        </strong></span>
                    @else
                    {{jddayofweek($item->scheduled_day-1,2)}}</strong></span>

                    @endif
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
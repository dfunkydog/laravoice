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
                <div class="catlist__count"><strong>{{$item->vendor->name}}</strong>: {{$item->description}} items</div>
                <div class="catlist__amount pill">
                    <sup>£</sup> {{$item->amount}}
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    @if (Route::currentRouteName()=== 'scheduled.index')
        <p><a href="{{route('listScheduled')}}">Show all</a></p>
    @endif
</section>
@endsection
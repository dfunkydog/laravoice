@extends('layouts.app')
@section('content')
<section class="section">
    <h1>{{__('Add a new scheduled expense')}}</h1>
    <form action={{ action( 'ScheduledExpenseController@update', ['scheduled' => $scheduled->id]) }} method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="pattern">How often? </label>
            <select name="pattern" id="pattern">
                @foreach ($patterns as $pattern)
                    <option value="{{ $pattern->id }}" {{ $scheduled->scheduled_pattern_id === $pattern ? 'selected' :''}}>{{ $pattern->pattern }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group {{ $errors->has('end_date') ? 'is-error' : '' }}">
            <label>Date to stop</label><input type="date" name="end_date" value={{$scheduled->date ? date('Y-m-d', $scheduled->end_date) : ''}}>
            {!! $errors->has('end_date')
            ? "<span class='is-error-message'>{$errors->first('end_date')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('scheduled_day') ? 'is-error' : '' }}">
            <select name="scheduled_day" id="scheduled_day">
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}" {{$scheduled->scheduled_day === $i ? 'selected' : ''}}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'is-error' : '' }}">
            <label for="description">Description</label>
            <input list="descriptions" name="description" type="text" value="{{ $scheduled->description }}">
            {!! $errors->has('description')
            ? "<span class='is-error-message'>{$errors->first('description')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'is-error': ''}}">
            <label for="amount">amount</label>
            <input name="amount" type="number" step="any" value="{{$scheduled->amount}}" > {!! $errors->has('amount') ? "<span class='is-error-message'>{$errors->first('amount')}</span>"
            : '' !!}
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="type_id" id="type">
                @foreach ($typeFields as $type)
                    <option value="{{ $type['id'] }}" {{ $scheduled->type_id === $type['id'] ? 'selected' : '' }}>{{ $type['name'] }}</option>
                @endforeach
            </select>
        </div>
        <datalist id="descriptions">
            @foreach ($descriptions as $description)
        <option value="{{$description->description}}"/>
            @endforeach
        </datalist>

        <div class="submit" onsubmit="this.disabled=true"><input type="submit" value="Save"></div>
    </form>
</section>
@endsection
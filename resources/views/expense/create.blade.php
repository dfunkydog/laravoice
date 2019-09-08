@extends('layouts.app') 
@section('content')
<section class="section">
    <h1><a href={{ action( 'ExpenseController@index') }}>Add a new expense</a></h1>
    <form action={{ action( 'ExpenseController@store') }} method="post">
        @csrf
        <div class="form-group">
            <label>Category</label>
            <select name="type_id" id="type">
                @foreach ($typeFields as $type)
                    <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group {{ $errors->has('paid_on') ? 'is-error' : '' }}">
            <label>Date</label><input type="date" name="paid_on" value={{old( 'paid_on', date( 'Y-m-d' ))}}>
            {!! $errors->has('paid_on')
            ? "<span class='is-error-message'>{$errors->first('paid_on')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('description') ? 'is-error' : '' }}">
            <label for="description">Description</label>
            <input list="descriptions" name="description" type="text" value={{old( 'description')}}> 
            {!! $errors->has('description')
            ? "<span class='is-error-message'>{$errors->first('description')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'is-error': ''}}">
            <label for="amount">amount</label>
            <input name="amount" type="number" step="any" value={{old( 'amount')}}> {!! $errors->has('amount') ? "<span class='is-error-message'>{$errors->first('amount')}</span>"
            : '' !!}
        </div>
        <div class="form-group {{ $errors->has('vendorName') ? 'is-error' : ''}}">
            <label for="vendorName">vendor</label>
            <input list="vendors" id="vendorName" name="vendorName" type="text" value={{ old( 'vendorName') }}> {!! $errors->has('vendorName')
            ? "<span class='is-error-message'>{$errors->first('vendorName')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('is_scheduled') ? 'is-error' : ''}}">
            <input id="is_scheduled" name="is_scheduled" value="1" type="checkbox" {{ old( 'is_scheduled') ? 'checked' : ''}}> {!! $errors->has('is_scheduled')
            ? "<span class='is-error-message'>{$errors->first('is_scheduled')}</span>" : '' !!}
            <label for="is_scheduled">Make this a scheduled expense</label>
        </div>
        @if(count($scheduled_pattern) > 0)
        <div class="form-group js-make_scheduled_options">
            <select name="pattern" id="pattern">
                @foreach ($scheduled_pattern as $pattern)
                    
            <option value="{{ $pattern->id }}">{{ $pattern->pattern }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <datalist id="vendors">
            @foreach ($vendors as $vendor)
        <option value="{{$vendor->name}}"/>
            @endforeach
        </datalist>
        <datalist id="descriptions">
            @foreach ($descriptions as $description)
        <option value="{{$description->description}}"/>
            @endforeach
        </datalist>

        <div class="submit" onsubmit="this.disabled=true"><input type="submit" value="Save"></div>
    </form>
</section>
@endsection
@extends('layouts.app')

@section('content')
    <h1><a href={{ action('ExpenseController@index') }}>All expenses</a></h1>
    @if ($errors->any())
        <ul class="danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <form action="/expenses" method="post">
        @csrf
        <select name="type_id" id="type">
            @foreach ($typeFields as $type)
                <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
            @endforeach
        </select>
        <div class="formfield"><input type="date" name="paid_on" value={{old('paid_on')}}></div>
        <div class="formfield">
            <label for="description">Description</label>
            <input
            name="description"
            type="text"
            value={{old('description')}}>
        </div>
        <div class="formfield">
            <label for="amount">amount</label>
            <input
            name="amount"
            type="number"
            step="any"
            value={{ old('amount') }}>
        </div>
        <div class="formfield">
            <label for="vendor">vendor</label>
            <input
            name="vendor"
            type="text"
            value={{ old('vendor') }}></div>
        <div class="submit"><input type="submit" value="Save"></div>
    </form>
@endsection
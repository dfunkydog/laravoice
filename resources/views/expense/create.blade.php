@extends('layouts.app') 
@section('content')
<section class="section">
    <h1><a href={{ action( 'ExpenseController@index') }}>All expenses</a></h1>
    @if ($errors->any())
    <ul class="danger">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form action={{ action( 'ExpenseController@store') }} method="post">
        @csrf
        <div class="form-group">
            <select name="type_id" id="type">
                @foreach ($typeFields as $type)
                    <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group"><input type="date" name="paid_on" value={{old( 'paid_on')}}></div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" type="text" value={{old( 'description')}}>
        </div>
        <div class="form-group">
            <label for="amount">amount</label>
            <input name="amount" type="number" step="any" value={{ old( 'amount') }}>
        </div>
        <div class="form-group">
            <label for="vendorName">vendor</label>
            <input list="vendors" id="vendorName" name="vendorName" type="text" value={{ old( 'vendorName') }}>
        </div>
        <datalist id="vendors">
            @foreach ($vendors as $vendor)
        <option value="{{$vendor->name}}"/>
            @endforeach
        </datalist>

        <div class="submit"><input type="submit" value="Save"></div>
    </form>
</section>
@endsection
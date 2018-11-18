@extends('layouts.app') 
@section('content')
<section class="section">
    <h1><a href={{ action( 'ExpenseController@index') }}>All expenses</a></h1>
    <a href="{{URL::previous()}}">BACK</a> @if ($errors->any())
    <ul class="danger">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form action={{ action( 'ExpenseController@update', [ 'expense'=>$expense->id]) }} method="post"> @csrf @method('PATCH')
        <select name="type_id" id="type">
            @foreach ($typeFields as $type)
                <option value="{{ $type->id }}" {{$expense->type_id === $type->id?'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>
        <div class="formfield"><input type="date" name="paid_on" value={{$expense->paid_on}}></div>
        <div class="formfield"><label for="description">Description</label><input name="description" type="text" value={{$expense->description}}></div>
        <div class="formfield"><label for="amount">amount</label><input name="amount" type="number" step="any" value={{$expense->amount}}></div>
        <div class="formfield"><label for="vendor">vendor</label><input name="vendor" type="text" value="{{ $expense->vendor->name }}"></div>
        <div class="submit"><input type="submit" value="Save"></div>
    </form>
</section>
@endsection
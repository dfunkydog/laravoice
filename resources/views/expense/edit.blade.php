@extends('layouts.app') 
@section('content')
<section class="section">
    <h1><a href={{ action( 'ExpenseController@index') }}>All expenses</a></h1>
    <a href="{{URL::previous()}}">BACK</a> @if ($errors->any())
    @endif
    <form action={{ action( 'ExpenseController@update', [ 'expense'=>$expense->id]) }} method="post"> @csrf @method('PATCH')
        <div class="form-group">
            <label>Category</label>
            <select name="type_id" id="type">
            @foreach ($typeFields as $type)
                <option value="{{ $type->id }}" {{$expense->type_id === $type->id?'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group {{ $errors->has('paid_on') ? 'is-error' : '' }}"><label>Date</label><input type="date" name="paid_on" value={{$expense->paid_on}}>
            {!! $errors->has('paid_on')
            ? "<span class='is-error-message'>{$errors->first('paid_on')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('description') ? 'is-error' : '' }}"><label for="description">Description</label><input name="description" type="text" value={{$expense->description}}>
          {!! $errors->has('description') ? "<span class='is-error-message'>{$errors->first('description')}</span>" : '' !!}
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'is-error' : '' }}"><label for="amount">Amount</label><input name="amount" type="number" step="any" value="{{$expense->amount}}">{!! $errors->has('amount')
            ? "<span class='is-error-message'>{$errors->first('amount')}</span>" : '' !!}</div>
        <div class="form-group {{ $errors->has('vendorName') ? 'is-error' : '' }}"><label for="vendor">Vendor</label><input name="vendorName" type="text" value="{{ $expense->vendor->name }}">{!! $errors->has('vendorName')
            ? "<span class='is-error-message'>{$errors->first('vendorName')}</span>" : '' !!}</div>
        <div class="submit"><input type="submit" value="Save"></div>
    </form>
</section>
@endsection
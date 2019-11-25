@extends('layouts.app') 
@section('content')
<section class="section">
    <h1>Total expenditure:for this month £{{$expenses->sum('amount') }} </h1>
    <table>
        <tr>
            <th>Category</th>
            <th>Amount</th>
            <th>description</th>
            <th>Vendor</th>
            <th>Date</th>
        </tr>
        @foreach ($expenses as $expense)
        <tr>
            <td>
                <a href="{{action('ExpenseController@show', ['expense' => $expense->id])}}">{{strtoupper($expense->type->name)}}</a></td>
            <td class="currency">
                £{{$expense->amount}}
            </td>
            <td>
                {{$expense->description}}
            </td>
            <td>
                {{$expense->vendor->name}}
            </td>
            <td> <strong>{{ $expense->paid_on }} </strong></td>
        </tr>
        @endforeach
    </table>
</section>
    @include('layouts.add-new')
@endsection
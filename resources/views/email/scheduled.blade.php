@extends('email.layout')
<div class="content">
<p><em>Hallo...</em></p>

<p>A reminder that the following {{ Illuminate\Support\Str::plural('expense', count($expenses)) }} {{ Illuminate\Support\Str::plural('is', count($expenses)) }} scheduled for payment today. </p>

<table>
    <tr>
        <th>Vendor name</th>
        <th>Amount</th>
    </tr>
    @foreach ($expenses as $expense)
    
    <tr>
        <td>{{$expense->vendor->name}}</td>
        <td>{{__('£')}}{{$expense->amount}}</td>
    </tr>
    @endforeach
</table>

<p>
{{ __( 'Make sure your account is funded, and check that the scheduled amounts are accurate.' ) }}
</p>
<p>&nbsp;</p>
<p>{{__('Regards')}}</p>
<p><em>{{__('Your friendly expense bot.')}}</em></p>
<div>

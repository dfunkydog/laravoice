<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1b1b1e">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name')}} - @yield('title')</title>
    <!-- Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
    @include('layouts.header') 
    @yield('content')
    <notifier></notifier>
            
    @if ($errors->any())
        <flash type="error" content="That didn't work, try again"></flash>
    @endif
    
    @if (session('status'))
        <flash  content="{{e(session('status'))}}"></flash>
    @endif
    
    <set-period :display="showPeriodSelect" :start="'{!! session('period') ? session( 'period' )[0]->format('Y-m-d') : ''!!}'"
            :end="'{!! session('period') ? session( 'period' )[1]->format('Y-m-d') : '' !!}'" @close=close token={{ csrf_token()
            }}></set-period>
            
    </div>

    <script src="{{ mix( 'js/app.js') }} "></script>
</body>

</html>
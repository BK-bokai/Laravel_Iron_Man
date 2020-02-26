<?php

// use Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href=" https://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css " rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        {{request()->get('is_login')}}
        {{\Request::get('is_login')}}
        @if( request()->get('is_login') )
        <script>
            console.log('hello')
        </script>
        @endif
        <a href="{{route('signOut')}}">登出</a>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <a href="#">聯絡我們</a>
    </footer>
</body>

</html>
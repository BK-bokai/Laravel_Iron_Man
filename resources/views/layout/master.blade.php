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
        @php
        $is_login=Session::get('is_login');
        $is_Admin=Session::get('is_Admin');
        @endphp
        @if ($is_login)
        <a href="{{route('signOut')}}">登出</a>
        <a href="{{route('trade')}}">購買紀錄</a>
        <a href="{{route('merchandise_home')}}">商品列表</a>
        @if ($is_Admin)
        <a href="{{route('merchandise_manage')}}">商品管理</a>
        <a href="{{route('merchandise_create')}}">新增商品</a>
        @endif
        @else
        <a href="{{route('do_signUp')}}">註冊</a>
        <a href="{{route('do_signIn')}}">登入</a>
        @endif

    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <a href="#">聯絡我們</a>
    </footer>
</body>

</html>
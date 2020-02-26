@extends('layout.master')
@section('title',$title)
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <!-- 錯誤訊息模板元件 -->
    <div class="social">
        <a href="#">分享到 Facebook</a>
        <a href="#">分享到 Twitter</a>
    </div>
    <form action="{{route('do_signIn')}}" method="post">
    {{ csrf_field() }}
        <!-- 手動加入 csrf_token 隱藏欄位，欄位變數名稱為 _token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <label>
            E-mail:
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" />
        </label>
        @error('email')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror

        <label>
            密碼:
            <input type="password" name="password" placeholder="密碼" value="{{ old('password') }}" />
        </label>
        @error('password')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror

        <button type="submit">登入</button>
    </form>
</div>
@endsection
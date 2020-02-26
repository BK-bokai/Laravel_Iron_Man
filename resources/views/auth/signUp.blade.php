@extends('layout.master')
@section('title',$title)
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <form action="{{route('do_signUp')}}" method="post">
        {{ csrf_field() }}
        <label>
            暱稱:
            <input type="text" name="nickname" placeholder="暱稱" value="{{ old('nickname') }}" />
        </label>
        @error('nickname')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror

        <label>
            E-mail:
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" />
        </label>
        @error('email')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror

        <label>
            密碼:
            <input type="password" name="password" placeholder="密碼"  />
        </label>
        @error('password')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror

        <label>
            確認密碼:
            <input type="password" name="password_confirmation" placeholder="確認密碼" />
        </label>
        @error('password_confirmation')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror

        <label>
            帳號類型:
            <select name="type">
                <option value="G">一般會員</option>
                <option value="A">管理者</option>
            </select>
        </label>
        @error('type')
        <p class="red-text" style='color:red;'> {{ $message }} </p>
        @enderror


        <button type="submit">註冊</button>
    </form>
</div>
@endsection
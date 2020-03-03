<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <p class="teal-text"> {{ session('status') }}  <p>
    <table class="table">
        <tr>
            <th>名稱</th>
            <td>{{ $Merchandise->name }}</td>
        <tr>
        <tr>
            <th>照片</th>
            <td>
                <img class="img_single" src="{{ $Merchandise->photo ?? asset('images/default-merchandise.jpg')}}"/>
            </td>
        <tr>
        <tr>
            <th>價格</th>
            <td>{{ $Merchandise->price }}</td>
        <tr>
        <tr>
            <th>剩餘數量</th>
            <td>{{ $Merchandise->remain_count }}</td>
        <tr>
        <tr>
            <th>介紹</th>
            <td>{{ $Merchandise->introduction }}</td>
        <tr>
        <tr>
            <td colspan="2">
                <form action="{{route('merchandise_buy',['Merchandise'=>$Merchandise->id])}}"
                    method="post">
                    購買數量
                    <select name="buy_count">\
                        @for($count=0;$count<=$Merchandise->remain_count;$count++)
                        <option value="{{ $count }}">{{ $count }}</option>
                        @endfor
                    </select>
                    <button type="submit">購買</button>
                    <!-- 自動產生 csrf_token 隱藏欄位-->
                    {!! csrf_field() !!}
                </form>
            </td>
        </tr>
    </table>

</div>
@endsection
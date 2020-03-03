<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <style>
        .img_show {
            width: 40px;
            height: 30px;
        }
    </style>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>名稱</th>
                <th>照片</th>
                <th>價格</th>
                <th>剩餘數量</th>
            </tr>
        </thead>
        <tbody>
            @foreach($MerchandisePaginate as $Merchandise)
            <tr>
                <td>
                    <a href="{{route('merchandise_item',['Merchandise'=>$Merchandise->id])}}">
                        {{ $Merchandise->name }}
                    </a>
                </td>
                <td>
                    <a href="{{route('merchandise_item',['Merchandise'=>$Merchandise->id])}}">
                        <img class="img_show" src="{{ $Merchandise->photo ?? asset('images/default-merchandise.jpg')}}" />
                    </a>
                </td>
                <td>{{ $Merchandise->price }}</td>
                <td>{{ $Merchandise->remain_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $MerchandisePaginate->links() }}
</div>
@endsection
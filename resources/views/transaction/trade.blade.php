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
        <tr>
            <th>商品資料</th>
            <th>圖片</th>
            <th>單價</th>
            <th>數量</th>
            <th>總金額</th>
            <th>購買時間</th>
        </tr>
        @foreach($TransactionPaginate as $Transaction)
        <tr>
            <td>
                <a href="{{route('merchandise_item',['Merchandise'=>$Transaction->Merchandise->id])}}">
                    {{ $Transaction->Merchandise->name }}
                </a>
            </td>
            <td>
                <a href="{{route('merchandise_item',['Merchandise'=>$Transaction->Merchandise->id])}}">
                    <img class="img_show" src="{{ $Transaction->Merchandise->photo  ?? asset('images/default-merchandise.jpg')}}" />
                </a>
            </td>
            <td>{{ $Transaction->price }}</td>
            <td>{{ $Transaction->buy_count }}</td>
            <td>{{ $Transaction->total_price }}</td>
            <td>{{ $Transaction->created_at }}</td>
        </tr>
        @endforeach
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $TransactionPaginate->links() }}
</div>
@endsection
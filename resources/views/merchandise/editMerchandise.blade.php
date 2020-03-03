<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <form action="{{route('merchandise_update', ['merchandise_id' => $Merchandise->id])}}" method="post" enctype="multipart/form-data">
        <!-- 隱藏方法欄位 -->
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div>
            商品狀態：
            <select name="status">
                <option value="C" @if(old('status', $Merchandise->status) == 'C')
                    selected
                    @endif
                    >建立中</option>
                <option value="S" @if(old('status', $Merchandise->status) == 'S')
                    selected
                    @endif
                    >可販售</option>
            </select>
            @error('status')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品名稱：
            <input type="text" name="name" placeholder="商品名稱" value="{{ old('name', $Merchandise->name) }}" />
            @error('name')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品英文名稱：
            <input type="text" name="name_en" placeholder="商品英文名稱" value="{{ old('name_en', $Merchandise->name_en) }}" />
            @error('name_en')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品介紹：
            <input type="text" name="introduction" placeholder="商品介紹" value="{{ old('introduction', $Merchandise->introduction) }}" />
            @error('introduction')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品英文介紹：
            <input type="text" name="introduction_en" placeholder="商品英文介紹" value="{{ old('introduction_en', $Merchandise->introduction_en) }}" />
            @error('introduction_en')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品照片：
            <input type="file" name="photo" placeholder="商品照片">
            <img class="img_edit" src="{{ $Merchandise->photo ?? asset('images/default-merchandise.jpg') }}" />
            @error('photo')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品價格：
            <input type="text" name="price" placeholder="商品價格" value="{{ old('price', $Merchandise->price) }}" />
            @error('price')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div>
            商品剩餘數量：
            <input type="text" name="remain_count" placeholder="商品剩餘數量" value="{{ old('remain_count', $Merchandise->remain_count) }}" />
            @error('remain_count')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-default">更新商品資訊</button>
        </div>

        <!-- 自動產生 csrf_token 隱藏欄位-->

    </form>
</div>
@endsection
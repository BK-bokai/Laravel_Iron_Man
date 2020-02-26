<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchandise;

class MerchandiseController extends Controller
{
    public function merchandiseItemPage(Request $request, $merchandise_id){
        return "你要看的商品ID為$merchandise_id";
    }
    public function merchandiseCreateProcess(Request $request){
        //建立商品基本資訊
        $merchandise_data = [
            'status' => 'C', //建立中
            'name' => '', //商品名稱
            'name_en' => '', //商品英文名稱
            'introduction' => '', //商品介紹
            'introduction_en' => '', //商品英文介紹
            'photo' => null, //商品照片
            'price' => 0, //價格
            'remain_count' => 0, //商品剩餘數量
        ];
        $Merchandise = Merchandise::create($merchandise_data);
        redirect(route('merchandise_edit',['merchandise_id'=>$Merchandise->id]));
    }

    public function merchandiseEditPage(Request $request, $merchandise_id){
        $Merchandise = merchandise::findOrFail('id',$merchandise_id);
        if(!isNull($Merchandise->photo)){
            $Merchandise->photo = url($Merchandise->photo);
        }
        $title = '編輯商品';
        return view('merchandise.editMerchandise', compact('title','Merchandise'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchandise;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Image;
// use Faker\Provider\Image;

class MerchandiseController extends Controller
{
    public function merchandiseListPage(Request $request)
    {
        //每頁資料量
        $row_per_page = 10;
        //撈取商品分業資料
        $MerchandisePaginate = Merchandise::OrderBy('created_at', 'desc')->where('status','S')->paginate($row_per_page);
    }
    public function merchandiseManageListPage(Request $request)
    {
        //每頁資料量
        $row_per_page = 10;
        //撈取商品分頁資料
        $MerchandisePaginate = Merchandise::OrderBy('created_at', 'desc')->paginate($row_per_page);
        //設定商品圖片網址
        foreach ($MerchandisePaginate as $Merchandise) {
            if (!is_null($Merchandise->photo)) {
                //設定商品圖片網址
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        $title = '商品管理';

        return view('merchandise.manageMerchandise',compact('MerchandisePaginate','title'));
    }
    public function merchandiseItemPage(Request $request, $merchandise_id)
    {
        return "你要看的商品ID為$merchandise_id";
    }
    public function merchandiseCreateProcess(Request $request)
    {
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
        return redirect(route('merchandise_edit', ['merchandise_id' => $Merchandise->id]));
    }

    public function merchandiseEditPage(Request $request, $merchandise_id)
    {
        $Merchandise = merchandise::where('id', $merchandise_id)->first();
        if (!is_Null($Merchandise->photo)) {
            $Merchandise->photo = url($Merchandise->photo);
        }
        $title = '編輯商品';
        return view('merchandise.editMerchandise', compact('title', 'Merchandise'));
    }

    public function merchandiseItemUpdateProcess(Request $request, $merchandise_id)
    {
        $input = $request->all();
        // return $request->all();
        $Merchandise = Merchandise::where('id', $merchandise_id)->first();
        //驗證規則
        $rules = [
            //商品狀態
            'status' => [
                'required',
                'in:C,S' //S前面不能有空格
            ],
            //商品名稱
            'name' => [
                'required',
                'max:80',
            ],
            //商品英文名稱
            'name_en' => [
                'required',
                'max:80',
            ],
            //商品介紹
            'introduction' => [
                'required',
                'max:2000',
            ],
            //商品英文介紹
            'introduction_en' => [
                'required',
                'max:2000',
            ],
            //商品照片
            'photo' => [
                'file',
                'image',
                'max:10240', //10 MB
            ],
            //商品價格
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            //商品剩餘數量
            'remain_count' => [
                'required',
                'integer',
                'min:0',
            ],
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            //資料驗證錯誤
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($input['photo'])) {
            //有上傳圖片
            // $photo = $input->file('photo');
            $photo = $input['photo'];
            //檔案副檔名
            $file_extension = $photo->getClientOriginalExtension();
            //產生自訂隨機檔案名稱
            // $file_name = uniqid() . '.' . $file_extension;
            $file_name = $photo->getClientOriginalName();

            //檔案相對路徑
            $file_relative_path = 'images\\merchandise\\' . $file_name;
            //檔案存取目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);

            Log::notice('原圖片路徑 = ' . $photo);
            Log::notice('圖片類型 = ' . $photo->getMimeType());
            Log::notice('新圖片路徑 = ' . $file_path);
            //裁切圖片
            $image = Image::make($photo)->fit(450, 300)->save($file_path);
            //設定圖片檔案相對位置
            $input['photo'] = $file_relative_path;

            $Merchandise->update($input);
            return redirect(route('merchandise_edit', ['merchandise_id' => $Merchandise->id]));
        }
    }
}

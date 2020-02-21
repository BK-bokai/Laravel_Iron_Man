<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    public function merchandiseItemPage(Request $request, $merchandise_id){
        return "你要看的商品ID為$merchandise_id";
    }
}

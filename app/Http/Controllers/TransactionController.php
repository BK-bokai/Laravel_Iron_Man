<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionListPage(){
        $title = '交易頁面';
        return view('transaction.trade',compact('title'));
    }
}

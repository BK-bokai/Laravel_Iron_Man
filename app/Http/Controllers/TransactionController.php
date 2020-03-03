<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Auth;
class TransactionController extends Controller
{
    public function transactionListPage(Request $request){
        $title = '交易頁面';
        //每頁資料量
        $row_per_page = 10;

        $user = Auth::user();
        // $Transation = Auth::user()->Transaction->OrderBy('created_at', 'desc')->paginate($row_per_page)->toArray();
        // return $Transation;
        $TransactionPaginate = Transaction::where('user_id',$user->id)->OrderBy('created_at', 'desc')->paginate($row_per_page);
        foreach ($TransactionPaginate as $Transaction) {
            $Transaction->Merchandise->photo = url($Transaction->Merchandise->photo);
        }
        return view('transaction.trade',compact('title','TransactionPaginate'));
    }
}

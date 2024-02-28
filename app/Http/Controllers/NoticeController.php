<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Notice;
use Illuminate\Http\Request;


class NoticeController extends Controller
{
    public function show( Transaction $transaction)
    {

        $notices = Notice::select('*')
        ->where('transaction_id', $transaction->id)
        ->get();

        return view('notice.show', ['notices' => $notices, 'transaction' => $transaction]);
}


public function adminshow( Transaction $transaction)
{

    $notices = Notice::select('*')
    ->where('transaction_id', $transaction->id)
    ->get();

    return view('notice.adminshow', ['notices' => $notices, 'transaction' => $transaction]);
}
}

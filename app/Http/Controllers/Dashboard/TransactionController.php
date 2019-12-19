<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Receipt;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Receipt::all();

        foreach($data as $row){
            $row = json_decode($row->name);

            // dd($row);
        }
        return view('dashboard.transaksi.index',['data'=>$data]);
    }
}

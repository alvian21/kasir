<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use Illuminate\Support\Facades\Auth;
use App\Receipt;


class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $data = Receipt::all();
            $sum = [];
            $total = [];
            foreach($data as $row){
                $total[]= intval($row->total);
              foreach(json_decode($row->name) as $ro => $val){
                $sum[] = intval($val->qty);


                    }
            }
            $hasil = array_sum($sum);
            $pemasukan = array_sum($total);
            return view('dashboard.index',['hasil'=>$hasil,'pemasukan'=>$pemasukan]);
        }

    }


    public function barang()
    {
        return view('dashboard.barang.index');
    }


    public function barangBaru(Request $request)
    {
        $barang = new Barang;
        $barang->name = $request->get('nama_barang');
        $barang->kode = $request->get('kode_barang');
        $barang->harga = $request->get('harga_barang');
        $barang->qty = $request->get('jml_barang');
        $barang->save();


    }


    public function fetchdata()
    {
        $barang = Barang::all();
        foreach($barang as $row){
            echo '<tr>';
            echo '<td id="id_brg" style="display:none;">'.$row->id.'</td>';
            echo '<td id="kode_brg">'.$row->kode.'</td>';
            echo '<td id="nama_brg">'.$row->name.'</td>';
            echo '<td id="jml_brg">'.$row->qty.'</td>';
            echo '<td id="harga_brg">'.$row->harga.'</td>';
            if($row->qty == 0){
                echo '<td>stok habis</td>';
            }elseif($row->qty < 10){
                echo '<td>stok hampir habis</td>';
            }elseif($row->qty >= 10){
                echo '<td>stok aman</td>';
            }
            echo '<td class=""> <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <button class="dropdown-item editdataku"  data-id="'.$row->id.'">Edit</button>
                    <button class="dropdown-item delete"  data-id="'.$row->id.'">Delete</button>
                    </div>
                </div>
          </td>';
            echo '</tr>';
        }

    }

    public function deleteBarang(Request $request)
    {
        if($request->get('delete')){
            $barang = Barang::find($request->get('id'));
            $barang->delete();
        }
    }

    public function editBarang(Request $request)
    {
        if($request->get('edit')){
            $barang = Barang::find($request->get('id'));
            $barang->kode = $request->get('kode');
            $barang->name = $request->get('nama');
            $barang->qty = $request->get('jml');
            $barang->save();
        }
    }

    public function logout()
    {
        $user = Auth::logout();
        return redirect('/');
    }
}

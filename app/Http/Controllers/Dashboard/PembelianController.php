<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Member;
use App\CustomClass\hitung;
use App\Receipt;

class PembelianController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        $member = Member::all();

        return view('dashboard.pembelian.index', ['data' => $data, 'member'=>$member]);
    }

    public function fetchform(Request $request)
    {

        if ($request->get('data') != null) {
            $data = Barang::find($request->get('data'));

            $echo = '';

            foreach ($data as $row) {
                $echo .= ' <label  class="form-control-label" for=""> ' . $row->name . ' <span class="text-danger">' . $row->harga . '</span></label>
                <input type="number" min="0" class="form-control form-control-alternative" name="datahitung" id="datahitung" data-id="' . $row->id . '" placeholder="jumlah ' . $row->name . '">';
            }

            echo $echo;
        }
    }


    public function hitung(Request $request)
    {
        $data = $request->get('data');
        $member = $request->get('member');

        // var_dump ($member[0]);

        $z = array();
        $final = array();


        foreach ($data as $key => $value) {

            foreach ($value as $row => $a) {
                    $b = $this->filter($a);
                    $hitung = $this->find($row, $b);
                    $kali = new hitung;
                    $result = $kali->result($b, $hitung->harga, $request->get('name'));

            }
            $z[$key] = $result;

            $intial = array('name: '.$hitung->name,
            'price: '.$hitung->harga,
            'qty: '.$b
            );

            foreach($intial as $dataku){
            list($key, $dataku) = explode(': ',$dataku);
            $final[$key] = $dataku;
            }
            $final = json_encode($final);
        }





        $hasil = array_sum($z);

        if(strpos($member,'no') !== false){

            $hasilnya = $request->get('uang') - $hasil;
            if($request->get('uang') > $hasil && $b!=""){
                echo 'Kembaliannya : '.$hasilnya;
                $hitung->save();
            }elseif($request->get('uang')==null){
                echo 'Masukkan jumlah uangnya';
            } else{
                echo 'uang anda kurang';
            }

        }else{
            $hasilnya = $hasil - (0.05 * $hasil);
            $hasilnya = $request->get('uang') - $hasilnya;
            if($request->get('uang') > $hasil && $b!=""){
                echo 'Kembaliannya : '.$hasilnya;
                $hitung->save();
            }elseif($request->get('uang')==null){
                echo 'Masukkan jumlah uangnya';
            } else{
                echo 'uang anda kurang';
            }

        }








    }

    public function digits($num)
    {
        return (int) (log($num, 10) + 1);
    }

    public function filter($data)
    {
        return (int) filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }


    public function dataku($data)
    {
        if ($data) {
            $data = json_encode($data);
            $data = str_replace('"', '', $data);
            return $data;
        }
    }

    public function sub($data)
    {
        $jumlah = substr($data, -3);
        $jumlah = $this->filter($jumlah);
        return $jumlah;
    }

    public function find($a, $b)
    {
        $hitung = Barang::find($a);
        $hitung->qty = $hitung->qty - $b;
        // $hitung->save();
        return $hitung;
    }
}

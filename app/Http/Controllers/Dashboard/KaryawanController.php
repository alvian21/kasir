<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Data;


class KaryawanController extends Controller
{
    public function karyawan()
    {
        $data = User::all()->where('role','karyawan');
        return view('dashboard.karyawan.index',['data'=>$data]);
    }

    public function create()
    {
        return view('dashboard.karyawan.create');
    }

    public function store(Request $request)
    {
        $user = New User;
        $karyawan = New Data;
        $user->role = 'karyawan';
        $user->name = $request->get('firstname').' '.$request->get('lastname');
        $user->email = $request->get('email');
        $user->password = bcrypt('user1234');
        $user->save();

        $karyawan->user_id = $user->id;
        $karyawan->first_name = $request->get('firstname');
        $karyawan->last_name = $request->get('lastname');
        $karyawan->phone_number = $request->get('numberphone');
        $data = $request->get('location_informations');
        $karyawan->location_informations = json_encode($data, true);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $filename = time() . '.' . $images->getClientOriginalExtension();
            Image::make($images)->resize(80, 80)->save(public_path('uploads/images/' . $filename));
            $karyawan->image = $filename;
        }

        $karyawan->save();
        return redirect()->back();

    }

    public function getEdit($id)
    {
        $data = Data::find($id);
        return view('dashboard.karyawan.edit',['data'=>$data]);
    }

    public function Edit(Request $request, $id)
    {
        $karyawan = Data::find($id);
        $user = User::find($karyawan->user_id);
        $user->email = $request->get('email');
        $karyawan->first_name = $request->get('firstname');
        $karyawan->last_name = $request->get('lastname');
        $karyawan->phone_number = $request->get('numberphone');
        $data = $request->get('location_informations');
        $karyawan->location_informations = json_encode($data, true);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $filename = time() . '.' . $images->getClientOriginalExtension();
            Image::make($images)->resize(80, 80)->save(public_path('uploads/images/' . $filename));
            $oldPhoto = $karyawan->image;
            //update ke database
            $karyawan = Data::find($id);
            $karyawan->image = $filename;
            //menghapus foto lama
            Storage::delete($oldPhoto);
        }

        $karyawan->save();
        $user->save();

        return redirect()->back();

    }

    public function delete(Request $request)
    {
        if($request->get('delete')){
            User::find($request->get('id'))->delete();
        }
    }
}

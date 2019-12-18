<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;

class MemberController extends Controller
{
    public function index()
    {
        return view('dashboard.member.index');
    }

    public function store(Request $request)
    {
        $member = new Member;
        $member->kode = $request->get('kode');
            $member->name = $request->get('nama');
            $member->email = $request->get('email');
            $member->phone_number = $request->get('nomerhp');
            $member->save();

    }

    public function fetchdata()
    {
        $member = Member::all();
        $no = 1;
        foreach($member as $row){

            echo '<tr>';
            echo '<td id="no">'.$no.'</td>';
            echo '<td id="id_member" style="display:none;">'.$row->id.'</td>';
            echo '<td id="kode_member">'.$row->kode.'</td>';
            echo '<td id="nama_member">'.$row->name.'</td>';
            echo '<td id="email_member">'.$row->email.'</td>';
            echo '<td id="hp_member">'.$row->phone_number.'</td>';
            echo '<td class=""> <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <button class="dropdown-item editmember"  data-id="'.$row->id.'">Edit</button>
                    <button class="dropdown-item deletemember"  data-id="'.$row->id.'">Delete</button>
                    </div>
                </div>
          </td>';
            echo '</tr>';
            $no++;
        }
    }

    public function delete(Request $request)
    {
        if($request->get('delete')){
            Member::find($request->get('id'))->delete();
        }
    }

    public function edit(Request $request)
    {
        $member = Member::find($request->get('id'));
        $member->kode = $request->get('kode');
        $member->name = $request->get('nama');
        $member->email = $request->get('email');
        $member->phone_number = $request->get('phone_number');
        $member->save();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use\App\Models\User;
use DataTables;

class UserController extends Controller
{
    public function userList(){
        return view('admin.users.user_list');
    }

    public function userListAjax(Request $request)
    {
        return datatables()->of(User::get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="#" class="btn btn-warning btn-sm" target="_blank">Edit</a>';
                if ($row->status == '1') {
                    $btn .='<a href="#" class="btn btn-danger btn-sm" >Disable</a>';
                } else {
                    $btn .='<a href="#" class="btn btn-primary btn-sm" >Enable</a>';
                }                
                return $btn;
            })->addColumn('user_gender', function($row){
                if ($row->gender == 'M'){
                    return 'Male';
                } else {
                    return 'Female';
                }
            })
            ->rawColumns(['action','user_gender'])
            ->make(true);
    }

}

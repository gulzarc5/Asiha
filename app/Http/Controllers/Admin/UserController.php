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
                $btn ='<a href="'.route('admin.edit_user_details', ['id' => $row->id]) .'" class="btn btn-warning btn-sm" target="_blank">Edit</a>';
                if ($row->status == '1') {
                    $btn .='<a href="'.route('admin.user_status', ['id' => encrypt($row->id),'status'=>2]) .'" class="btn btn-danger btn-sm" >Disable</a>';
                } else {
                    $btn .='<a href="'.route('admin.user_status', ['id' => encrypt($row->id),'status'=>1]) .'" class="btn btn-primary btn-sm" >Enable</a>';
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

    public function EditUser($id){
        $user_data = User::where('id',$id)->first();
        return view('admin.users.edit_user_form',compact('user_data'));

    }

    public function userUpdate(Request $request,$id){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required'
        ]);

        $checkemail = User::where('email',$request->input('email'))->where('id','!=',$id)->count();
        $checkmobile = User::where('mobile',$request->input('mobile'))->where('id','!=',$id)->count();
        if($checkemail>0 or $checkmobile>0){
            return redirect()->back()->with('message','Email or Mobile No already taken');
        }
        else{
            User::where('id',$id)->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'pin'=>$request->input('pin'),
                'address'=>$request->input('address'),
                'gender'=>$request->input('gender'),
                'dob'=>$request->input('dob'),

            ]);
            return redirect()->back()->with('message','Details updated successfully!');
        }

    }

    public function userStatus($id,$status){

        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $userstatus = User::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();

    }

}

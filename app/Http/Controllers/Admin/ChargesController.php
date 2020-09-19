<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\charges;
class ChargesController extends Controller
{
    public function chargesList()
    {
        $charges = Charges::orderBy('id','desc')->get();
        return view('admin.charges.charges_list',compact('charges')); 
    }

    public function chargesEdit($charges_id)
    {
        try {
            $id = decrypt($charges_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $charges = Charges::where('id',$id)->first();
        
        return view('admin.charges.edit_charges',compact('charges'));
    }

    public function chargesUpdate(Request $request,$id)
    {   
        $this->validate($request, [
            'amount'   => 'required',
            
        ]);
        Charges::where('id',$id)
            ->update([
                'amount'=>$request->input('amount'),
               
        ]);
        return redirect()->back()->with('message','Charges Updated Successfully');
        
    }

    public function chargesStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $charges = Charges::where('id',$id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }


}

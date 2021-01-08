<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        $user_count = User::where('status',1)->count();
        $products_count = Product::where('status',1)->count();
        $new_order_count = Order::where('order_status',1)->count();
        $packed_order_count = Order::where('order_status',2)->count();
        $shipped_order_count = Order::where('order_status',3)->count();
        $return_request_count = Order::where('order_status',6)->count();

        $date = Carbon::now();
        $to_date = $date->toDateTimeString();
        $from_date = $date->subMonths(3)->toDateTimeString();

        $delivered_order_pie = $this->pieData($from_date,$to_date,4);
        $cancelled_order_pie = $this->pieData($from_date,$to_date,5);
        $returned_order_pie = $this->pieData($from_date,$to_date,7);

        $total = ($returned_order_pie+$cancelled_order_pie+$delivered_order_pie);
        $pie = [
            'delivered_order_pie' => $total == 0 ? 0 : round(($delivered_order_pie*100)/$total),
            'cancelled_order_pie' => $total == 0 ? 0 : round(($cancelled_order_pie*100)/$total),
            'returned_order_pie' => $total == 0 ? 0 : round(($returned_order_pie*100)/$total),
        ];

        $chart = $this->chartData();
        $orders = Order::orderBy('id','desc')->limit(10)->get();
        return view('admin.dashboard',compact('user_count','products_count','new_order_count','packed_order_count','shipped_order_count','return_request_count','pie','chart','orders'));
    }

    function pieData($from_date,$to_date,$status)
    {
        $data = Order::where('order_status',$status)->whereBetween('created_at',[$from_date,$to_date])->count();
        return $data;
    }

    function chartData(){
        $data[] = [
            'level' => Carbon::now()->format('Y-m'),
            'delivered' => $this->chartQueryDelivered(Carbon::now()->month),
            'cancel' => $this->chartQueryCancel(Carbon::now()->month),
        ];

        for ($i=1; $i < 11; $i++) {
            $data[] = [
                'level' => Carbon::now()->subMonths($i)->format('Y-m'),
                'delivered' => $this->chartQueryDelivered(Carbon::now()->subMonths($i)->month),
                'cancel' => $this->chartQueryCancel(Carbon::now()->subMonths($i)->month),
            ];
        }
        return $data;
    }

    function chartQueryDelivered($month){
        $delivered = Order::where('order_status',4) ->whereMonth('created_at', $month)->count();
        return $delivered;
    }

    function chartQueryCancel($month){
        $cancel = Order::where('order_status',5) ->whereMonth('created_at', $month)->count();
        return $cancel;
    }

    public function changePasswordForm()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'same:confirm_password'],
        ]);

        $user = Admin::where('id',1)->first();

        if(Hash::check($request->input('current_password'), $user->password)){
            Admin::where('id',1)->update([
                'email' =>$request->input('email'),
'                password'=>Hash::make($request->input('new_password')),
            ]);
        }else{
            return redirect()->back()->with('error','Sorry Current Password Does Not Correct');
        }
    }
}

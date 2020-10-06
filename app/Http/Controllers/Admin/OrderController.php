<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use DataTables;
use App\Models\InvoiceSetting;

class OrderController extends Controller
{
    public function orderList()
    {
        $orders = Order::paginate(25);
        return view('admin.order.order_list',compact('orders'));
    }

    // public function dispatchedList()
    // {
    //     $orders = Order::where('order_status',2)->get();
    //     return view('admin.order.dispatched_list',compact('orders'));
    // }

    // public function orderList()
    // {
    //     return view('admin.order.all_order_list');
    // }

    // public function orderListAjax(Request $request)
    // {
    //     return datatables()->of(Order::orderBy('id','desc')->get())
    //         ->addIndexColumn()
    //         ->addColumn('action', function($row){
    //             $btn ='<a href="#" class="btn btn-warning btn-sm" target="_blank">View Order</a>';
    //             return $btn;
    //         })->addColumn('user_name', function($row){
    //            return $row->user->name;
    //         })->addColumn('amount_data', function($row){
    //             return number_format($row->amount,2,".",'');
    //          })
    //         ->rawColumns(['action','user_name','amount_data'])
    //         ->make(true);
    // }

    public function orderDetails($order_id)
    {
        $order = Order::find($order_id);
        $invoice_setting = InvoiceSetting::find(1);
        // $OrderDetails = OrderDetails::where('order_id')->
        return view('admin.order.order_details',compact('order','invoice_setting'));
    }

    public function statusUpdate($order_list_id,$status)
    {
        $order_list = OrderDetails::find($order_list_id);
        $order_list->order_status = $status;

        if ($status == '5') {
        }elseif ($status == '6') {
            $order_list->order_status = $status;
        }else{
            $order_list->order_status = $status;
        }

    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetalis;
use App\Models\ProductSize;
use DataTables;
use App\Models\RefundInfo;
use App\Models\InvoiceSetting;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function orderList(Request $request)
    {
        if ($request->has('search_key')) {
            $search_key = $request->input('search_key');
            $orders = Order::where('id', 'like', '%'.$search_key.'%')->orderBy('id','desc')->paginate(25);
        }else{
            $orders = Order::orderBy('id','desc')->paginate(25);
        }
        // $orders = Order::paginate(25);
        return view('admin.order.order_list',compact('orders'));
    }

    public function orderDetails($order_id)
    {
        $order = Order::find($order_id);
        $invoice_setting = InvoiceSetting::find(1);
        // $OrderDetails = OrderDetalis::where('order_id')->
        return view('admin.order.order_details',compact('order','invoice_setting'));
    }

    public function statusUpdate($order_list_id,$status)
    {
        $order_item = OrderDetalis::find($order_list_id);
        $order_item->order_status = $status;
        if ($status == '4') {
            $order_item->delivery_date = Carbon::now()->timezone('Europe/Stockholm')->toDateString();
        }
        $order_item->save();
        if ($status == 5) {
            $this->stockUpdate($order_item->product_id,$order_item->quantity,$order_item->size);
        }

        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        // return response()->json($status, 200);
        $order = Order::find($order_item->order_id);
        $order->order_status = $status;
        $order->save();
        return 1;
    }

    private function stockUpdate($product_id,$quantity,$size_name){
        // $sizes = Size::where('name',$size_name)->get();
        $size = ProductSize::where('product_sizes.product_id',$product_id)
                ->join('sizes','sizes.id','=','product_sizes.size_id')
                ->where('sizes.name',$size_name)
                ->select('product_sizes.id as id','product_sizes.stock as stock')
                ->first();
        if ($size) {
            $stock_update = ProductSize::find($size->id);
            $stock_update->stock = $stock_update->stock+$quantity;
            $stock_update->save();
        }
        return 1;
    }

    public function refundInfoForm($order_item_id)
    {
        $order_item = OrderDetalis::find($order_item_id);

        /// All orders are cancelled = 5 or return request = 6 or returned = 7 if so then add shipping amount with refund
        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        $order = Order::find($order_item->order_id);
        $amount = $order_item->quantity*$order_item->price;
        $discount = (($amount*$order_item->discount)/100);
        if ($status == 5 || $status == 6 || $status == 7 ) {
            $refund_amount = ($amount+$discount+$order_item->order->shipping_charge);
        }else{
            $refund_amount = ($amount+$discount);
        }

        return view('admin.refund.refund_info',compact('order_item','refund_amount'));
    }

    public function refundInfoInsert(Request $request,$order_item_id)
    {
        $this->validate($request, [
            'name'   => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'ac_no' => 'required',
            'ifsc' => 'required'
        ]);
        $order_item = OrderDetalis::find($order_item_id);
        $order_item->order_status = 5;
        $order_item->refund_request = 2;
        $order_item->save();

        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        $order = Order::find($order_item->order_id);
        $order->order_status = $status;
        $order->save();

        $amount = $order_item->quantity*$order_item->price;
        $discount = (($amount*$order_item->discount)/100);
        if ($status == 5 || $status == 6 || $status == 7 ) {
            $order_item->refund_amount = ($amount-$discount+$order_item->order->shipping_charge);
        }else{
            $order_item->refund_amount = ($amount-$discount);
        }
        $order_item->save();

        $refund_info = new RefundInfo();
        $refund_info->order_id = $order_item->id;
        $refund_info->amount = $order_item->refund_amount;
        $refund_info->name = $request->input('name');
        $refund_info->bank_name = $request->input('bank_name');
        $refund_info->ac_no = $request->input('ac_no');
        $refund_info->ifsc = $request->input('ifsc');
        $refund_info->branch_name = $request->input('branch_name');
        $refund_info->save();
        return redirect()->route('admin.order_list');
    }

    public function refundInfoView($order_id)
    {
       $refund_info = RefundInfo::where('order_id',$order_id)->first();
       return view('admin.refund.refund_info_view',compact('refund_info'));
    }

    public function refundList()
    {
        $orders = OrderDetalis::where('refund_request','!=',1)->orderBy('id','desc')->get();
        return view('admin.order.refund_list',compact('orders'));
    }

    public function refundUpdate($order_list_id)
    {
        $status = 7;
        $order_item = OrderDetalis::find($order_list_id);
        $order_item->order_status = $status;
        $order_item->refund_request = 3;
        $order_item->save();

        $all_order = OrderDetalis::where('order_id',$order_item->order_id)->get();
        $status = 7;
        foreach ($all_order as $key => $item) {
            if ($item->order_status < $status) {
                $status = $item->order_status;
            }
        }
        // return response()->json($status, 200);
        $order = Order::find($order_item->order_id);
        $order->order_status = $status;
        $order->save();

        $refund_info = RefundInfo::where('order_id',$order_list_id)->first();
        $refund_info->refund_status = 2;
        $refund_info->save();
        return 1;
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Order;
use App\User;
use App\Checkout;
use App\Orderreturn;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd('this is orders');
        $checkouts = Checkout::with('user', 'orders')->where("status", '!=', 'not confirmed')->get();
        //dd($checkouts);
        return view('admin.order.order', compact('checkouts'));
    }


    public function listItems($id)
    {
        //
        $checkout = Checkout::with('user','orders', 'orders.product')->findOrFail($id);
        //dd($checkout);
        return view('admin.order.item', compact('checkout'));

    }
    public function printItems($id)
    {
        $checkout = Checkout::with('user','orders', 'orders.product', 'area')->findOrFail($id);
        //dd($checkout);
        $html = '<p>Order No: '.$checkout->id.'</p>'
                .'<p>Customer Name: '.$checkout->user->name.'</p>'
                .'<p>Phone: '.$checkout->user->mobile.'</p>'
                .'<p>Address: '.$checkout->user->address.'</p>'
                .'<p>Area: '.$checkout->area->area_name.'</p>'
                .'<div><table>'
                .'<tr>'
                .'<th>Product Name</th>'
                .'<th>Quantity</th>'
                .'<th>Nos</th></tr>';
        foreach ($checkout->orders as $order) {
            $html .= '<tr>'
                    .'<td>'.$order->product->product_name.'</td>'
                    .'<td>'.$order->pqty.'</td>'
                    .'<td>'.$order->nos.'</td>'
                    .'</tr>';
        }
        $html .= '</table></div>';
        //dd($html);

        
        return PDF::loadHTML($html)->stream();

    }
    public function changeStatus($id, $status)
    {
        //
        dd($id);
        $current_status = "Order Placed";
        if($status === '1')
        {
            $current_status = "Order Placed";

        }
        elseif($status === '2')
        {
            $current_status = "Ready for Dispatch";
        }
        elseif($status === '3')
        {
            $current_status = "In Transit";
        }
        elseif($status === '4')
        {
            $current_status = "Delivered";
        }
        $checkout = Checkout::find($id);
        $checkout->status = $current_status;
        $checkout->save();
        dd($checkout);
        return redirect()->route('orders');

    }

   public function returns()
   {
        $returns = Orderreturn::with('order_return', 'order_return.orders',  'order_return.orders.product', 'user')->get();
        //dd($returns);
        return view('admin.order.returns', compact('returns'));
   }

   public function returnsstatus($id, $status)
   {
        $return = Orderreturn::findOrFail($id);
        switch ($status) {
            case 1:
                $return->status = 'Booked';
                break;
            
            case 2:
                $return->status = 'Not Reachable';
                break;
            
            case 3:
                $return->status = 'Returned';
                break;
            
            case 4:
                $return->status = 'Negotiated';
                break;
            
            default:
                 $return->status = 'Booked';
                break;
        }
        $return->save();
        return redirect()->route('admin.returns');

   }

   public function viewreturn($id)
   {
        $return = Orderreturn::with('orders', 'user')->first();
        return view('admin.order.viewreturn', compact('return'));
   }
}

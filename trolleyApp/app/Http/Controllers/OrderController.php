<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Order;
use App\User;
use App\Checkout;
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
        //dd($checkout);
        return redirect()->route('orders');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

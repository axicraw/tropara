<h3>Your order has been placed..</h3>

<table width="100%" class="cart-table">
  <tr>
    <th>Product</th>
    <th>Qty</th>
    <th>PRICE</th>
    <th width="80">NOS</th>
    <th>SUBTOTAL</th>
  </tr>
  @foreach($orders as $order)
  <tr>
    <td>{{ $order->product->product_name }}
        
    </td>
    <td>{{ $order->pqty }}</td>
    <td>{{ $order->price }}</td>
    <td>{{ $order->nos }}</td>
    <td>{{ $order->price * $order->nos }}</td>
  </tr>
  @endforeach
  
</table>
<h3>An Order has been placed by <?=$user->name?></h3>

<p>Order id : <?=$checkout->id?></p>


<table width="100%" class="cart-table" border="1">
  <tr>
    <th>Product</th>
    <th>Qty</th>
    <th>PRICE</th>
    <th width="80">NOS</th>
    <th>SUBTOTAL</th>
  </tr>
  <?php 
    foreach ($orders as $order) {
  ?>
      <tr>
        <td><?= $order->product->product_name ?>
            
        </td>
        <td><?= $order->pqty ?></td>
        <td>Rs. <?= $order->offered_price ?></td>
        <td><?= $order->nos ?></td>
        <td>Rs. <?= ($order->offered_price * $order->nos) ?></td>
      </tr>
  <?php
    }
  ?>
  <tr>
  	<p style="text-align:right">Total : Rs. <?=$checkout->total?></p>
  </tr>
  
</table>


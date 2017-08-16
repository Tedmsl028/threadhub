<?php
	require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerpartial.php';

  if($cart_id != ''){
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_encode($result['items'], true);
    $i = 1;
    $sub_total = 0;
    $item_count = 0;
  }

?>

<div class="col-md-12">
  <div class="row">
    <h2 class="text-center">My Shopping Cart</h2><hr>
    <?php if($cart_id == '2'): ?>
      <div class="bg-danger">
        <p class="text-center text-danger">
          Your shopping cart is empty.
        </p>
      </div>
    <?php else: ?>
      <table class="table table-bordered table-condensed table-striped">
        <thead><th class="bg-success">#</th><th class="bg-success">Item</th><th class="bg-success">Price</th><th class="bg-success">Quantity</th><th class="bg-success">Size</th><th class="bg-success">Sub Total</th></thead>
        <tbody>
          <?php
            foreach ($items as $item){
              $product_id = $item['id'];
              $productQ = $db->query("SELECT * FROM products WHERE product_id = '{$product_id}'");
                $product = mysqli_fetch_assoc($productQ);
                $sArray = explode(',',$product['sizes']);
                foreach ($sArray as $sizeString){
                  $s = explode(':',$sizeString);
                  if($s[0] == $item['size']){
                    $available = $s[1];
                  }
                }
                ?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$product['title'];?></td>
                  <td><?=money($product['price']);?></td>
                  <td>
										<button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$product['product_id'];?>','<?=$item['size'];?>);">-</button>
										<?=$item['quantity'];?>
										<?php if($item['quantity'] < $available): ?>
											<button class="btn btn-xs btn-default" onclick="update_cart('addone','<?=$product['product_id'];?>','<?=$item['size'];?>);">+</button>
										<?php else: ?>
												<span class="text-danger">Max</span>
										<?php endif; ?>
									</td>
                  <td><?=$item['size'];?></td>
                  <td><?=money($item['quantity'] * $product['price']);?></td>
                </tr>
          <?php
            $i++;
            $item_count += $item['quantity'];
            $sub_total += ($product['price'] * $item['quantity']);
          }
          $tax = TAXRATE * $sub_total;
          $tax = number_format($tax,2);
          $grand_total = $tax + $sub_total;
           ?>
        </tbody>
      </table>
      <table class="table table-bordered table-condensed text-right">
        <legend>Totals</legend>
        <thead class="totals-table-header"><th>Total Items</th><th>Sub Total</th><th>Tax</th><th>Grand Total</th></thead>
        <tbody>
          <tr>
            <td><?=$item_count;?></td>
            <td><?=money($sub_total);?></td>
            <td><?=money($tax);?></td>
            <td class="bg-success"><?=money($grand_total);?></td>
          </tr>
        </tbody>
      </table>
      <!-- Check Out Buttonl -->
      <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#checkoutModal">
        <span class="glyphicon glyphicon-shopping-cart"></span>Proceed To Checkout
      </button>

      <!-- Modal -->
      <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
            </div>
            <div class="modal-body">
							<div class="row">
							<form action="thankYou.php" method="post" id="payment-form">
								<div id="step1" style="display:none;">
									<div class="form-group col-md-6">
										<label for="full_name">Full Name: *</label>
										<input class="form-control" id="full_name" name="full_name" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email: *</label>
										<input class="form-control" id="email" name="email" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="complex">Complex/Building:<br><i>optional</i></label>
										<input class="form-control" id="complex" name="complex" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="street">Street Address: *</label>
										<input class="form-control" id="street" name="street" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="street2"></label>
										<input class="form-control" id="street2" name="street2" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="suburb">Suburb: *</label>
										<input class="form-control" id="suburb" name="suburb" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="province">Province: *</label>
										<input class="form-control" id="province" name="province" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="city">City: *</label>
										<input class="form-control" id="city" name="city" type="text">
									</div>
									<div class="form-group col-md-6">
										<label for="postal_code">Postal Code: *</label>
										<input class="form-control" id="postal_code" name="postal_code" type="text">
									</div>
									</div>
									<div id="step2" style="display:block;">
										<div class="form-group col-md-3">
											<label for="name">Name on Card:</label>
											<input type="text" class="form-control" id="name">
										</div>
										<div class="form-group col-md-3">
											<label for="number">Card Number:</label>
											<input type="text" class="form-control" id="number">
										</div>
										<div class="form-group col-md-2">
											<label for="cvv">CVV:</label>
											<input type="text" class="form-control" id="cvv">
										</div>
										<div class="form-group col-md-2">
											<label for="exp-month">Expire Month:</label>
											<select id="exp-month" class="form-control">
												<option value=""></option>
												<?php for($i=1;$i<13; $i++): ?>
													<option value="<?=$i;?>"><?=$i;?></option>
												<?php endfor; ?>
											</select>
										</div>
										<div class="form-group col-md-3">
											<label for="exp-year">Expire Year:</label>
											<select id="exp-year" class="form-control">
												<option value=""></option>
												<?php $yr = date("Y"); ?>
												<?php for($i=0;$i<11; $i++): ?>
													<option value="<?=$yr+$i;?>"><?=$yr+$i;?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>
            </div>
					</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" onclick="check_address();" id="next_button">Next</button>
							<button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display:none;">Back</button>
							<button type="button" class="btn btn-primary" id="checkout_button" style="display:none;">Proceed To Checkout</button>
							</form>
						</div>
          </div>
        </div>
      </div>
  <?php endif; ?>
  </div>
</div>
<script>
	function back_address(){
			jQuery('#payment-errors').html("");
			jQuery('#step1').css("display","block");
			jQuery('#step2').css("display","none");
			jQuery('#next_button').css("display","inline-block");
			jQuery('#back_button').css("display","none");
			jQuery('#checkout_button').css("display","none");
			jQuery('#checkoutModalLabel').html("Shipping Address");
	}

	function check_address(){
		var data = {
			'full_name' : jQuery('#full_name').val(),
			'email' : jQuery('#email').val(),
			'complex' : jQuery('#complex').val(),
			'street' : jQuery('#street').val(),
			'street2' : jQuery('#street2').val(),
			'suburb' : jQuery('#suburb').val(),
			'province' : jQuery('#province').val(),
			'city' : jQuery('#city').val(),
			'postal_code' : jQuery('#postal_code').val(),
		};
		jQuery.ajax({
			url : '/threadhub/admin/parsers/check_address.php',
			method : 'POST',
			data : data,
			success : function(data){
				if(data != 'passed'){
					jQuery('#payment-errors').html(data);
				}
				if(data == 'passed'){
					alert('#payment-errors').html("");
					jQuery('#step1').css("display","none");
					jQuery('#step2').css("display","block");
					jQuery('#next_button').css("display","none");
					jQuery('#back_button').css("display","inline-block");
					jQuery('#checkout_button').css("display","inline-block");
					jQuery('#checkoutModalLabel').html("Banking Card Details");
				}
			},
			error : function(){
				alert("Oops, Something Went Wrong!");
			},
		});
	}
</script>
<?php include 'includes/footer.php';?>

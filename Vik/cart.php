<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Cart</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <?php include 'partials/user/userstyle.html'; ?>
   </head>
   <body style="margin: 0; padding: 0;">
 <!-- Header Section -->
 <?php include 'partials/user/userheader.html'; ?>
<!-- End Header Section -->  
        <!-- Shopping Cart section start -->
            <div class="shopping_cart_section layout_padding">
                <div class="container">
                    <h1 class="shopping_cart_title">Your Shopping Cart</h1>
                    <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td><img src="images/img-3.png" class="cart_product_image"></td>
                                <td>Chair 01</td>
                                <td><input type="number" value="1" class="form-control cart_quantity"></td>
                                <td>$10.00</td>
                                <td>$10.00</td>
                                <td><button class="btn btn-danger">Remove</button></td>
                                </tr>
                                <tr>
                                <td><img src="images/img-4.png" class="cart_product_image"></td>
                                <td>Chair 02</td>
                                <td><input type="number" value="2" class="form-control cart_quantity"></td>
                                <td>$15.00</td>
                                <td>$30.00</td>
                                <td><button class="btn btn-danger">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart_total">
                            <h3>Total: $40.00</h3>
                            <div class="checkout_btn"><a href="checkout.html" class="btn btn-success">Proceed to Checkout</a></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Shopping Cart section end -->
            <?php include 'partials/user/userfooter.html'; ?>
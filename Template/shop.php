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
      <title>Shopping Cart</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- style -->
       <?php include '/Applications/XAMPP/xamppfiles/htdocs/TWP-Project/Template/partials/user/userstyle.html'; ?>
       
      <style>
         .cart_product_image {
            width: 100px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
         }
      </style>
   </head>
   <body>
 <!-- header section -->
  <?php include '/Applications/XAMPP/xamppfiles/htdocs/TWP-Project/Template/partials/user/userheader.html'; ?>
<!-- header section end -->

   <!-- Category Section -->
<div class="category_section layout_padding">
   <div class="container">
      <h1 class="category_title">Our Products</h1>
      <p class="category_text">Browse through our exclusive collection of chairs.</p>
      <div class="row d-flex flex-wrap">
         <!-- Chair 01 -->
         <div class="col-md-4 d-flex">
            <div class="box_main">
               <p class="chair_text">Chair 01</p>
               <div class="image"><img src="images/img-8.png" alt="Chair 01"></div>
               <p class="price_text">Price $100</p>
               <div class="buy_bt"><a href="partials/user/chair01.php">Buy Now</a></div>
            </div>
         </div>
         <!-- Chair 02 -->
         <div class="col-md-4 d-flex">
            <div class="box_main">
               <p class="chair_text">Chair 02</p>
               <div class="image"><img src="images/img-4.png" alt="Chair 02"></div>
               <p class="price_text">Price $100</p>
               <div class="buy_bt"><a href="partials/user/chair02.php">Buy Now</a></div>
            </div>
         </div>
         <!-- Chair 03 -->
         <div class="col-md-4 d-flex">
            <div class="box_main">
               <p class="chair_text">Chair 03</p>
               <div class="image"><img src="images/img-7.png" alt="Chair 03"></div>
               <p class="price_text">Price $100</p>
               <div class="buy_bt"><a href="partials/user/chair05.php">Buy Now</a></div>
            </div>
         </div>
         <!-- Chair 04 -->
         <div class="col-md-4 d-flex">
            <div class="box_main">
               <p class="chair_text">Chair 04</p>
               <div class="image"><img src="images/img-6.png" alt="Chair 04"></div>
               <p class="price_text">Price $120</p>
               <div class="buy_bt"><a href="partials/user/chair06.php">Buy Now</a></div>
            </div>
         </div>
         <!-- Chair 05 -->
         <div class="col-md-4 d-flex">
            <div class="box_main">
               <p class="chair_text">Chair 05</p>
               <div class="image"><img src="images/img-whitechair.png" alt="Chair 05" width="200" height="200"></div>
               <p class="price_text">Price $200</p>
               <div class="buy_bt"><a href="#">Buy Now</a></div>
            </div>
         </div>
         <!-- Chair 06 -->
         <div class="col-md-4 d-flex">
            <div class="box_main">
               <p class="chair_text">Chair 06</p>
               <div class="image"><img src="images/img-blackchair.png" alt="Chair 06"></div>
               <p class="price_text">Price $300</p>
               <div class="buy_bt"><a href="#">Buy Now</a></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Category Section End -->
      <!-- footer section -->
       <?php include '/Applications/XAMPP/xamppfiles/htdocs/TWP-Project/Template/partials/user/userfooter.html'; ?>
      <style>
         .box_main {
             display: flex;
             flex-direction: column;
             justify-content: space-between;
             height: 100%;
         }
         .d-flex {
             display: flex;
         }
         .flex-wrap {
             flex-wrap: wrap;
         }
         .price_text {
            text-align: center;
         }
         </style>
   </body>
</html>
<?php
   session_start();
   include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Basic Meta Tags -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Viewport Settings -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <!-- Page Title and SEO Meta Tags -->
      <title>Vik</title>
      <?php include 'partials/user/userstyle.html'; ?>
   </head>

   <body>
      <!-- Header Section start -->
      <?php include 'partials/user/userheader.html'; ?>  
      <!-- Header Section end -->

      <!-- banner section start -->
       <?php include 'partials/user/banner.php'; ?>
      <!-- banner section end -->
       
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <div class="about_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="image_2"><img src="images/img-2.png"></div>
                  </div>
                  <div class="col-md-6">
                     <h1 class="about_taital">About Us</h1>
                     <p class="about_text">Meet the team behind the scene.</p>
                     <div class="readmore_bt"><a href="about.html">Read More</a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!--  design section start -->
      <div class="design_section layout_padding">
         <div id="my_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item">
                  <div class="container">
                     <h1 class="design_taital">Our Work Furniture</h1>
                     <p class="design_text">Vik introduces our wide variety of designs. Click Read More for more infomation.</p>
                     <div class="design_section_2">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 04</p>
                                 <div class="image_3" href="#"><img src="images/img-6.png"></div>
                                 <p class="chair_text">Price $120</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 05</p>
                                 <div class="image_4" href="#"><img src="images/img-whitechair.png"></div>
                                 <p class="chair_text">Price $200</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 06</p>
                                 <div class="image_4" href="#"><img src="images/img-blackchair.png"></div>
                                 <p class="chair_text">Price $300</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>                           
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="carousel-item active">
                  <div class="container">
                     <h1 class="design_taital">Our Work Furniture</h1>
                     <p class="design_text">FiU introduces our wide variety of designs. Click Read More for more infomation.</p>
                     <div class="design_section_2">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 01</p>
                                 <div class="image_4" href="#"><img src="images/img-8.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 02</p>
                                 <div class="image_3" href="#"><img src="images/img-4.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 03</p>
                                 <div class="image_4" href="#"><img src="images/img-7.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <h1 class="design_taital">Our Work Furniture</h1>
                     <p class="design_text">FiU introduces our wide variety of designs. Click Read More for more infomation.</p>
                     <div class="design_section_2">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 01</p>
                                 <div class="image_4" href="#"><img src="images/img-8.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 02</p>
                                 <div class="image_3" href="#"><img src="images/img-4.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 03</p>
                                 <div class="image_4" href="#"><img src="images/img-7.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <h1 class="design_taital">Our Work Furniture</h1>
                     <p class="design_text">FiU introduces our wide variety of designs. Click Read More for more infomation.</p>
                     <div class="design_section_2">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 01</p>
                                 <div class="image_4" href="#"><img src="images/img-8.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 02</p>
                                 <div class="image_3" href="#"><img src="images/img-4.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="box_main">
                                 <p class="chair_text">Chair 03</p>
                                 <div class="image_4" href="#"><img src="images/img-7.png"></div>
                                 <p class="chair_text">Price $100</p>
                                 <div class="buy_bt"><a href="#">Buy Now</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
            <i class="fa fa-long-arrow-left" style="font-size:24px"></i>
            </a>
            <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
            <i class="fa fa-long-arrow-right" style="font-size:24px"></i>
            </a>
         </div>
         <div class="container">
            <div class="read_bt"><a href="design.html">Read More</a></div>
         </div>
      </div>
      <!--  design section end -->
      <!--  newsletter section start -->
      <div class="newsletter_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="imgage_6"><img src="images/img-6.png"></div>
               </div>
               <div class="col-md-6">
                  <h1 class="newsletter_taital">Subscribe Newsletter</h1>
                  <input type="text" class="email_text" placeholder="Enter Your Email" name="Enter Your Email">
                  <div class="subscribe_bt"><a href="#">Subscribe Now</a></div>
               </div>
            </div>
         </div>
      </div>
      <!--  newsletter section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container">
            <div class="contact_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="mail_section_1">
                        <h1 class="contact_taital">Contact Us</h1>
                        <input type="text" class="mail_text" placeholder="Name" name="text">
                        <input type="text" class="mail_text" placeholder="Email" name="text">
                        <input type="text" class="mail_text" placeholder="Phone Number" name="text">
                        <textarea class="massage-bt" placeholder="Message" rows="5" id="comment" name="Message"></textarea>
                        <div class="send_bt"><a href="#">SEND</a></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="map_main">
                        <div class="map-responsive">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.7421047515095!2d102.2737111744706!3d2.2500769080222507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e56b9710cf4b%3A0x66b6b12b75469278!2sMultimedia%20University!5e0!3m2!1sen!2smy!4v1736254219521!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->

      <!-- footer section start -->
      <?php include 'partials/user/userfooter.html'; ?>
      <!-- footer section end -->
       
   </body>
</html>
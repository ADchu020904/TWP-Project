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
      <meta name="keywords" content="furniture, modern design, home decor">
      <meta name="description" content="Premium furniture with contemporary designs">
      <meta name="author" content="Your Name">

      <!-- CSS Imports -->
      <!-- Bootstrap Framework -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Custom Styles -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive Styles -->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- Custom Scrollbar -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Icon Fonts -->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <!-- Fancybox -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!-- Custom Font -->
      <link href="https://fonts.googleapis.com/css2?family=Londrina+Shadow&family=Londrina+Solid:wght@100;300;400;900&display=swap" rel="stylesheet">
      
      <!-- Favicon -->
      <link rel="icon" href="images/vik.ico" type="image/x-icon">
   </head>

   <body>
      <!-- Header Section -->
      <div class="header_section">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
               <!-- Brand Logo -->
               <a class="logo" href="index.html"><img src="images/Vik.png"></a>

               <!-- Mobile Menu Toggle -->
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                       aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>

               <!-- Navigation Items -->
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left-aligned Navigation Items -->
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="design.html">Our Design</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="shop.html">Shop</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                     </li>
                  </ul>

                  <!-- Right-aligned Icons -->
                  <ul class="navbar-nav ms-auto">
                     <!-- Cart Icon -->
                     <li class="nav-item">
                        <a class="nav-link" href="cart.html">
                            <!-- Added 'cart-icon' class for specific sizing -->
                            <img src="images/cart.png" alt="Cart Icon" class="nav-icon cart-icon">
                        </a>
                    </li>
                     
                     <!-- User Dropdown -->
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <img src="images/user-icon.png" alt="User Icon" class="nav-icon user-icon">
                     </a>
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                           <a class="dropdown-item" href="account.html">My Account</a>
                           <a class="dropdown-item" href="usersignup.php">Log in/Sign up</a>
                           <a class="dropdown-item" href="index.html">Log Out</a>
                           <a class="dropdown-item" href="admin-login.html">Admin Login</a>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </div>
      <!-- End Header Section -->     
      <!-- banner section start -->
<div class="banner_section layout_padding">
   <!-- First Slider -->
   <div id="main_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h1 class="banner_taital">Best <br> Design <br>of Furniture</h1>
                      <p class="banner_text">High quality products.</p>
                      <div class="btn_main">
                        <div class="contact_bt"><a href="contact.html">Contact Us</a></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="image_1"><img src="images/img-1.png" alt="Modern Furniture Design showcasing a stylish chair"></div>
                    </div>
                  </div>
               </div>
             </div>
             <div class="carousel-item">
               <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h1 class="banner_taital">Modern <br> Living <br> Solutions</h1>
                      <p class="banner_text">Explore the finest designs crafted for elegance.</p>
                      <div class="btn_main">
                        <div class="contact_bt"><a href="about.html">Learn More</a></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="image_1"><img src="images/img-whitechair.png" alt="Modern white chair for living solutions" class="slider-image"></div>
                    </div>
                  </div>
               </div>
             </div>
           </div>
           <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
             <i style="font-style: initial;">01</i>
           </a>
           <a class="carousel-control-next" id="show-second-slider" href="#main_slider" role="button" data-slide="next">
             <i style="font-style: initial;">02</i>
           </a>
         </div>

         <!-- Second Slider -->
         <div id="second_slider" class="carousel slide hidden" data-ride="carousel">
           <div class="carousel-inner">
             <div class="carousel-item active">
               <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h1 class="banner_taital">Exclusive <br> Designs</h1>
                      <p class="banner_text">Discover timeless designs for your dream home.</p>
                      <div class="btn_main">
                        <div class="contact_bt"><a href="contact.html">Contact Us</a></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="image_1"><img src="images/img-1.png" alt="Exclusive Designs showcasing a stylish chair" class="slider-image"></div>
                    </div>
                  </div>
               </div>
             </div>
         <div class="carousel-item">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="banner_taital">Elegant <br> Interiors</h1>
                     <p class="banner_text">Crafted for beauty and functionality.</p>
                     <div class="btn_main">
                        <div class="contact_bt"><a href="about.html">Learn More</a></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="image_1"><img src="images/img-4.png" alt="Elegant interior design showcasing a modern living room"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <a class="carousel-control-prev" href="#second_slider" role="button" data-slide="prev">
         <i style="font-style: initial;">01</i>
      </a>
      <a class="carousel-control-next" href="#second_slider" role="button" data-slide="next">
         <i style="font-style: initial;">02</i>
      </a>
   </div>
</div>
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
      <div class="footer_section">
         <div class="container">
            <div class="footer_location_text">
               <ul>
                  <li><img src="images/map-icon.png"><span class="padding_left_10"><a href="#">Our Official Website</a></span></li>
                  <li><img src="images/call-icon.png"><span class="padding_left_10"><a href="#">Call : +1112223334</a></span></li>
                  <li><img src="images/mail-icon.png"><span class="padding_left_10"><a href="#">demo@gmail.com</a></span></li>
               </ul>
            </div>
            <div class="row">
               <div class="col-lg-3 col-sm-6">
                  <h2 class="useful_text">Useful link </h2>
                  <div class="footer_menu">
                     <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="design.html">Our Design</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h2 class="useful_text">Repair</h2>
                  <p class="lorem_text">If there're any problems regarding the products please head to our repair center</p>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h2 class="useful_text">Social Media</h2>
                  <div id="social">
                     <a class="facebookBtn smGlobalBtn active" href="#" ></a>
                     <a class="twitterBtn smGlobalBtn" href="#" ></a>
                     <a class="googleplusBtn smGlobalBtn" href="#" ></a>
                     <a class="linkedinBtn smGlobalBtn" href="#" ></a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <h1 class="useful_text">Our Repair center</h1>
                  <p class="footer_text">Jalan Ayer Keroh Lama, 75450 Bukit Beruang, Melaka </p>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- JavaScript Files -->
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <!-- Popper.js -->
      <script src="js/popper.min.js"></script>
      <!-- Bootstrap -->
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- Custom Scripts -->
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- Scrollbar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Fancybox -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   </body>
</html>
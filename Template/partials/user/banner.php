<style>
            /* Carousel Customization */
            .carousel-indicators [data-bs-target] {
            width: 40px;
            height: 4px;
            border-radius: 2px;
            background-color: rgba(124,44,12,0.3);
            border: none;
            margin: 0 5px;
            transition: all 0.3s ease;
            }

            .carousel-indicators .active {
            background-color: #7c2c0c;
            height: 5px;
            margin-top: -1px;
            }

            .carousel-control-prev,
            .carousel-control-next {
            width: 40px;
            height: 40px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.9;
            background: none;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
            filter: none;
            width: 30px;
            height: 30px;
            background-image: none;
            }

            .carousel-control-prev-icon::before {
            content: "‹";
            font-size: 2.5rem;
            color: #7c2c0c;
            }

            .carousel-control-next-icon::before {
            content: "›";
            font-size: 2.5rem;
            color: #7c2c0c;
            }
            </style>
            
<div class="banner_section layout_padding">
         <!-- Main Slider -->
         <div id="mainCarousel" class="carousel slide" data-coreui-ride="true">
            <!-- Indicators -->
            <div class="carousel-indicators">
                  <button type="button" data-coreui-target="#mainCarousel" data-coreui-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-coreui-target="#mainCarousel" data-coreui-slide-to="1" aria-label="Slide 2"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                  <!-- Slide 1 -->
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
                                 <div class="image_1">
                                    <img src="images/img-1.png" class="d-block w-100" alt="Modern Furniture Design">
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>

                  <!-- Slide 2 -->
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
                                 <div class="image_1">
                                    <img src="images/img-whitechair.png" class="d-block w-100" alt="Modern White Chair">
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="carousel-control-prev" type="button" data-coreui-target="#mainCarousel" data-coreui-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-coreui-target="#mainCarousel" data-coreui-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
            </button>
         </div>
      </div>
      <!-- banner section end -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chair 01 - Product Details</title>
    <link rel="stylesheet" href="/TWP-Project/Vik/css/bootstrap.min.css">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include 'userstyle.html'; ?>
   
   <style>

        .product-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #bb9180;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .product-image {
            max-width: 400px;
            height: auto;
            margin-right: 20px;
        }
        .product-details {
            flex: 1;
        }
        .product-details h2 {
            color: #343a40;
        }
        .product-details p {
            margin: 10px 0;
            color: #495057;
        }
        .star-rating {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }
        .star-rating .star {
            font-size: 1.5em;
            color: #ffca08;
            margin-right: 5px;
        }
        .btn-addtocart {
            background-color: #7c2c0c;
            border-color: #bb9180;
            color: #ffffff;
            width: 100%;
            margin-top: 20px;
        }
        .btn-addtocart:hover {
            background-color: #bb9180;
            border-color: #bb9180;
        }
        .review-link, .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #7c2c0c;
            text-decoration: none;
        }
        .review-link:hover, .back-link:hover {
            text-decoration: underline;
        }
        .header_section {
            margin-bottom: 50px !important; /* Add space below the header */
        }
    </style>
</head>
<body>
<!-- Header Section -->
<div class="header_section">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
       <!-- Brand Logo -->
       <a class="logo" href="index.php"><img src="/TWP-Project/Vik/images/Vik.png"></a>

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
          <a class="nav-link" href="/TWP-Project/Vik/index.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/TWP-Project/Vik/about.html">About</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/TWP-Project/Vik/design.html">Our Design</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/TWP-Project/Vik/shop.php">Shop</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/TWP-Project/Vik/contact.html">Contact Us</a>
          </li>
       </ul>

       <!-- Right-aligned Icons -->
       <ul class="navbar-nav ms-auto">
          <!-- Cart Icon -->
          <li class="nav-item">
          <a class="nav-link" href="/TWP-Project/Vik/cart.html">
              <!-- Added 'cart-icon' class for specific sizing -->
              <img src="/TWP-Project/Vik/images/cart.png" alt="Cart Icon" class="nav-icon cart-icon">
          </a>
         </li>
          
          <!-- User Dropdown -->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" 
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img src="/TWP-Project/Vik/images/user-icon.png" alt="User Icon" class="nav-icon user-icon">
          </a>
          <!-- Dropdown Menu -->
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
             <a class="dropdown-item" href="/TWP-Project/Vik/account.php">My Account</a>
             <a class="dropdown-item" href="/TWP-Project/Vik/usersignup.php">Log in/Sign up</a>
             <a class="dropdown-item" href="/TWP-Project/Vik/index.php">Log Out</a>
             <a class="dropdown-item" href="/TWP-Project/Vik/admin-login.html">Admin Login</a>
          </div>
          </li>
       </ul>
       </div>
    </div>
    </nav>
 </div>
 <!-- End Header Section -->      
    <div class="product-container">
        <img src="/TWP-Project/Vik/images/img-8.png" alt="Chair 01" class="product-image">
        <div class="product-details">
            <h2>Chair 01</h2>
            <p><strong>Price:</strong> $100</p>
            <div class="star-rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <p><strong>Stock:</strong> 20 units available</p>
            <button class="btn btn-addtocart">Add to Cart</button>
            <a href="/TWP-Project/Vik/review.html" class="review-link">Give a Review</a>
            <a href="/TWP-Project/Vik/shop.php" class="back-link">Go Back to Shop</a>
        </div>
    </div>
    <script src="/TWP-Project/Vik/js/jquery.min.js"></script>
    <script src="/TWP-Project/Vik/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
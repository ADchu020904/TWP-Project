<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chair 01 - Product Details</title>
  
  <!-- Set the base URL so that all relative links work as expected -->
  <base href="/TWP-Project/Vik/">
  
  <!-- CSS Imports -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <?php include 'userstyle.html'; ?>
  
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  
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
    <?php include 'userheader.html'; ?>
  
  <!-- Product Details Section -->
  <div class="product-container">
    <img src="images/img-8.png" alt="Chair 01" class="product-image">
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
      <a href="review.html" class="review-link">Give a Review</a>
      <a href="/../../shop.php" class="back-link">Go Back to Shop</a>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

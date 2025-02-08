<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: usersignup.php");
    exit();
}

// Fetch user data
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT firstName, lastName, email FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle password change
if(isset($_POST['change_password'])) {
    $current = $_POST['current-password'];
    $new = $_POST['new-password'];
    $confirm = $_POST['confirm-password'];
    
    if($new === $confirm) {
        // Add password update logic here
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $hashedPassword = password_hash($new, PASSWORD_BCRYPT);
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();
    }
}

// Handle logout
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" style="margin: 0; padding: 0;">
<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Account</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/vik.ico" type="image/gif" /> 
</head>
<body>
 <!-- Header Section -->
 <div class="header_section">
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
         <!-- Brand Logo -->
         <a class="logo" href="index.php"><img src="images/Vik.png"></a>

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
                  <a class="nav-link" href="index.php">Home</a>
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
                     <a class="dropdown-item" href="index.php">Log Out</a>
                     <a class="dropdown-item" href="admin-login.html">Admin Login</a>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </nav>
</div>
<!-- End Header Section --> 
    
    <!-- account section start -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card">
                    <?php
                    $initials = strtoupper(substr($user['firstName'], 0, 1) . substr($user['lastName'], 0, 1));
                    ?>
                    <div class="profile-initials"><?php echo htmlspecialchars($initials); ?></div>
                    <h5 class="card-title"><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($user['email']); ?></p>
                    <button class="btn btn-outline-danger">Edit Details</button>
                    <form method="POST" style="margin-top: 10px;">
                        <button type="submit" name="logout" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="accountTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="personal-details-tab" data-toggle="tab" href="#personal-details" role="tab" aria-controls="personal-details" aria-selected="true">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="order-history-tab" data-toggle="tab" href="#order-history" role="tab" aria-controls="order-history" aria-selected="false">Order History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="account-settings-tab" data-toggle="tab" href="#account-settings" role="tab" aria-controls="account-settings" aria-selected="false">Account Settings</a>
                    </li>
                </ul>
                <div class="tab-content" id="accountTabsContent">
                    <div class="tab-pane fade show active" id="personal-details" role="tabpanel" aria-labelledby="personal-details-tab">
                        <h3 class="mt-3">Personal Details</h3>
                        <p>Name: <?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></p>
                        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                        
                        <!-- Address Section -->
                        <h4 class="mt-4">Addresses</h4>
                        <button class="btn btn-outline-danger mb-4" onclick="toggleAddressForm()">Add a New Address</button>
                        
                        <!-- Address Form (Hidden by default) -->
                        <div id="addressForm" style="display: none;">
                            <form method="POST" class="address-form">
                                <div class="form-group mb-3">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" required>
                                    <small class="form-text text-muted">Complete name of the person receiving the order</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-group">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" id="countryCodeBtn" style="height: 46px;">
                                            MY (+60)
                                        </button>
                                        <ul class="dropdown-menu country-dropdown">
                                            <li><a class="dropdown-item" href="#" data-code="+60">MY (+60) Malaysia</a></li>
                                            <li><a class="dropdown-item" href="#" data-code="+66">TH (+66) Thailand</a></li>
                                        </ul>
                                        <input type="hidden" name="countryCode" id="countryCode" value="+60">
                                        <input type="tel" class="form-control" id="phone" required>
                                    </div>
                                    <small class="form-text text-muted">Used for order updates and delivery contact</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" rows="3" required></textarea>
                                    <small class="form-text text-muted">E.g. Unit/building name, street name</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="postalCode">Postal Code</label>
                                    <input type="text" class="form-control" id="postalCode" required>
                                    <small class="form-text text-muted">Please enter your 5-digit postal code, e.g. 50050</small>
                                </div>
                                <div class="button-group">
                                    <button type="submit" class="btn btn-outline-danger" style="padding: 10px 20px !important; font-size: 16px !important;">Save Address</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="toggleAddressForm()" style="padding: 10px 20px !important; font-size: 16px !important;">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="order-history" role="tabpanel" aria-labelledby="order-history-tab">
                        <h3 class="mt-3">Order History</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>
                                    <td>Shipped</td>
                                    <td>$100.00</td>
                                </tr>
                                <tr>
                                    <td>#67890</td>
                                    <td>Delivered</td>
                                    <td>$150.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="account-settings" role="tabpanel" aria-labelledby="account-settings-tab">
                        <h3 class="mt-3">Account Settings</h3>
                        <form method="POST">
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" class="form-control" name="current-password" required>
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" class="form-control" name="new-password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm-password" required>
                            </div>
                            <button type="submit" name="change_password" class="btn btn-outline-danger">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- account section end -->
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
                     <li><a href="index.php">Home</a></li>
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
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <!-- javascript --> 
   <script src="js/owl.carousel.js"></script>
   <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   <script>
function toggleAddressForm() {
    const form = document.getElementById('addressForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

document.querySelectorAll('.country-dropdown .dropdown-item').forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        const code = e.target.dataset.code;
        const text = e.target.textContent.split(') ')[0] + ')';
        document.getElementById('countryCodeBtn').textContent = text;
        document.getElementById('countryCode').value = code;
    });
});
</script>
</body>
</html>


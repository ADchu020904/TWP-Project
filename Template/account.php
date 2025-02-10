<?php
// ============================================================================
//  Configuration and Setup
// ============================================================================

// Start session for user authentication and message passing
session_start();

// Include database connection details
include 'connect.php';

// ============================================================================
//  Security Functions
// ============================================================================

/**
 * Sanitize Input Data
 *
 * This function sanitizes user input to prevent Cross-Site Scripting (XSS)
 * attacks.
 *
 * @param string $data The data to be sanitized.
 * @return string The sanitized data.
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// ============================================================================
//  Display Functions
// ============================================================================

/**
 * Display Session Message
 *
 * This function displays session messages (success or error) and then unsets
 * the session variable to prevent displaying the message multiple times.
 */
function displayMessage() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

// ============================================================================
//  Authentication and User Data
// ============================================================================

// Check if user is logged in; redirect to signup page if not
if (!isset($_SESSION['email'])) {
    header("Location: usersignup.php");
    exit();
}

// Fetch user data from the database
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT firstName, lastName, email FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// ============================================================================
//  Form Handling Logic
// ============================================================================

/**
 * Handle Password Change Form Submission
 *
 * This function handles the submission of the password change form,
 * validating the input and updating the user's password in the database.
 */
function handlePasswordChange($conn, $email) {
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
}

/**
 * Handle Logout Form Submission
 *
 * This function handles the submission of the logout form, destroying the
 * session and redirecting the user to the home page.
 */
function handleLogout() {
    if(isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}

/**
 * Handle Address Form Submission
 *
 * This function handles the submission of the address form, validating the
 * input and saving the address to the database.
 */
function handleAddressForm($conn, $email) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_address'])) {
        // Sanitize and collect input data
        $full_name = sanitizeInput($_POST['full_name']);
        $country_code = sanitizeInput($_POST['country_code']);
        $phone_number = sanitizeInput($_POST['phone_number']);
        $address = sanitizeInput($_POST['address']);
        $postal_code = sanitizeInput($_POST['postal_code']);
        
        // Validate inputs
        $errors = [];
        if (empty($full_name)) $errors[] = "Full name is required";
        if (empty($phone_number)) $errors[] = "Phone number is required";
        if (empty($address)) $errors[] = "Address is required";
        if (!preg_match('/^\d{5}$/', $postal_code)) $errors[] = "Invalid postal code format";
        
        // If no validation errors, save the address to the database
        if (empty($errors)) {
            if (isset($_POST['address_id']) && !empty($_POST['address_id'])) {
                // Update existing address
                $stmt = $conn->prepare("UPDATE addresses SET full_name = ?, country_code = ?, phone_number = ?, address = ?, postal_code = ? WHERE id = ?");
                $stmt->bind_param("sssssi", $full_name, $country_code, $phone_number, $address, $postal_code, $_POST['address_id']);
            } else {
                // Insert new address
                $stmt = $conn->prepare("INSERT INTO addresses (user_id, full_name, country_code, phone_number, address, postal_code) 
                                        VALUES ((SELECT id FROM users WHERE email = ?), ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $email, $full_name, $country_code, $phone_number, $address, $postal_code);
            }
            if ($stmt->execute()) {
                $_SESSION['message'] = '<div class="alert alert-success">Address saved successfully!</div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger">Error saving address. Please try again.</div>';
                error_log("Database error saving address: " . $conn->error); // Log the error
            }
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
        }
        header("Location: account.php"); // Redirect to clear the POST data
        exit();            
    }
}

// Add a block to handle delete_address requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_address'])) {
    $idToDelete = (int)$_POST['delete_address']; 
    $stmt = $conn->prepare("DELETE FROM addresses WHERE id = ? AND user_id = (SELECT id FROM users WHERE email = ?)");
    $stmt->bind_param("is", $idToDelete, $_SESSION['email']);
    $stmt->execute();
    // Return a simple success message or appropriate response
    echo json_encode(['success' => true]);
    exit();
}

// Add this to your PHP section at the top where other handlers are
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $newName = sanitizeInput($_POST['full_name']);
    $newEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        // Split the full name into first and last name
        $nameParts = explode(' ', $newName, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        
        $stmt = $conn->prepare("UPDATE users SET firstName = ?, lastName = ?, email = ? WHERE email = ?");
        $stmt->bind_param("ssss", $firstName, $lastName, $newEmail, $_SESSION['email']);
        
        if ($stmt->execute()) {
            $_SESSION['email'] = $newEmail; // Update session with new email
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
        exit();
    }
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit();
}

// ============================================================================
//  Process Incoming Form Requests
// ============================================================================

// Process password change form
handlePasswordChange($conn, $email);

// Process logout form
handleLogout();

// Process address form
handleAddressForm($conn, $email);

// ============================================================================
//  Data Retrieval for Display
// ============================================================================

// Fetch existing addresses for the user
$addressStmt = $conn->prepare("SELECT * FROM addresses WHERE user_id = (SELECT id FROM users WHERE email = ?)");
$addressStmt->bind_param("s", $email);
$addressStmt->execute();
$addresses = $addressStmt->get_result();

// ============================================================================
//  HTML Output (Views)
// ============================================================================
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
   <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="../css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="../css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/vik.ico" type="image/gif" /> 
   <style>
        /* Styles for profile card */
        .profile-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-initials {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #df0951;
            color: white;
            font-size: 2.5em;
            line-height: 80px;
            margin: 0 auto 20px;
        }

        .profile-card .card-title {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 5px;
        }

        .profile-card .card-text {
            color: #666;
            margin-bottom: 15px;
        }

        .profile-card .btn-outline-danger {
            width: auto;
            padding: 8px 20px;
            font-size: 1em;
        }

        /* Styles for address cards */
        .address-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .address-card .card-header {
            background: #f0f0f0;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            border-radius: 7px 7px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .address-card .card-header h5 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .address-card .card-body {
            padding: 15px;
            color: #555;
        }

        .address-card .card-body p {
            margin-bottom: 8px;
        }

        .address-card .icon-group {
            display: flex;
            gap: 5px;
        }

        .address-card .icon-btn {
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 0;
            font-size: 1em;
            transition: color 0.3s;
        }

        .address-card .icon-btn:hover {
            color: #df0951;
        }

        /* General form styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
            color: #444;
        }

        .form-control:focus {
            border-color: #df0951;
            box-shadow: 0 0 5px rgba(223, 9, 81, 0.2);
            outline: none;
        }

        .button-group {
            margin-top: 20px;
        }

        .button-group .btn {
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-group .btn-outline-danger {
            color: #df0951;
            border-color: #df0951;
        }

        .button-group .btn-outline-danger:hover {
            background-color: #df0951;
            color: white;
        }

        /* Alert messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
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
                     <a class="dropdown-item" href="account.php">My Account</a>
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
                    <div class="edit-profile-form" style="display: none; margin-top: 20px;">
                        <form id="profileEditForm" method="POST" class="text-left">
                            <div class="form-group mb-3">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" name="full_name" id="fullName" 
                                       value="<?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="button-group d-flex justify-content-between">
                                <button type="submit" class="btn btn-outline-danger">Save Changes</button>
                                <button type="button" class="btn btn-outline-danger" onclick="toggleProfileEdit()">Cancel</button>
                            </div>
                        </form>
                    </div>
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
    <div class="personal-info-section mb-4">
        <div class="info-group">
            <label>Name:</label>
            <span class="user-name"><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></span>
        </div>
        <div class="info-group">
            <label>Email:</label>
            <span class="user-email"><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
    </div>

    <!-- Address Section -->
    <h4 class="mt-4">Addresses</h4>
    
    <?php 
        displayMessage(); // Display any session messages
    ?>
    
    <div id="address-container" class="mb-4">
        <?php while($address = $addresses->fetch_assoc()): ?>
        <div 
            class="address-card"
            data-id="<?= $address['id'] ?>"
            data-full_name="<?= htmlspecialchars($address['full_name']) ?>"
            data-country_code="<?= htmlspecialchars($address['country_code']) ?>"
            data-phone_number="<?= htmlspecialchars($address['phone_number']) ?>"
            data-address="<?= htmlspecialchars($address['address']) ?>"
            data-postal_code="<?= htmlspecialchars($address['postal_code']) ?>"
        >
            <div class="card-header">
                <h5><?= htmlspecialchars($address['full_name']) ?></h5>
                <div class="icon-group">
                    <button class="icon-btn edit-btn"><i class="fa fa-pencil"></i></button>
                    <button class="icon-btn delete-btn"><i class="fa fa-trash-can"></i></button>
                </div>
            </div>
            <div class="card-body">
                <p><?= htmlspecialchars($address['address']) ?></p>
                <p><?= htmlspecialchars($address['postal_code']) ?></p>
                <p><?= htmlspecialchars($address['country_code'].' '.$address['phone_number']) ?></p>
            </div>
            <div class="edit-form" style="display: none; margin-top: 1rem;">
                <form method="POST">
                    <input type="hidden" name="address_id" value="<?= $address['id'] ?>">
                    <div class="form-group mb-3">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" name="full_name" value="<?= htmlspecialchars($address['full_name']) ?>" required>
                        <small class="form-text text-muted">Complete name of the person receiving the order</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" id="countryCodeBtn" style="height: 46px;">
                                <?= htmlspecialchars($address['country_code']) ?>
                            </button>
                            <ul class="dropdown-menu country-dropdown">
                                <li><a class="dropdown-item" href="#" data-code="+60">MY (+60) Malaysia</a></li>
                                <li><a class="dropdown-item" href="#" data-code="+66">TH (+66) Thailand</a></li>
                            </ul>
                            <input type="hidden" name="country_code" id="countryCode" value="<?= htmlspecialchars($address['country_code']) ?>">
                            <input type="tel" class="form-control" name="phone_number" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= htmlspecialchars($address['phone_number']) ?>" required>
                        </div>
                        <small class="form-text text-muted">Used for order updates and delivery contact</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" rows="3" required><?= htmlspecialchars($address['address']) ?></textarea>
                        <small class="form-text text-muted">E.g. Unit/building name, street name</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="postalCode">Postal Code</label>
                        <input type="text" 
                               class="form-control" 
                               name="postal_code" 
                               pattern="[0-9]{5}"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                               maxlength="5"
                               value="<?= htmlspecialchars($address['postal_code']) ?>" 
                               required>
                        <small class="form-text text-muted">Please enter your 5-digit postal code, e.g. 50050</small>
                    </div>
                    <div class="button-group d-flex justify-content-between">
                        <button type="submit" name="save_address" class="btn btn-outline-danger" style="padding: 10px 20px !important; font-size: 16px !important;">Save Changes</button>
                        <button type="button" class="btn btn-outline-danger cancel-edit-btn" style="padding: 10px 20px !important; font-size: 16px !important;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <button class="btn btn-outline-danger mb-4" style="margin-top: 2rem;" onclick="toggleAddressForm()">Add a New Address</button>
    <div id="addressForm" style="display: none;">
    <form method="POST" class="address-form">
        <input type="hidden" name="address_id" id="addressId">
        <div class="form-group mb-3">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" name="full_name" required>
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
                <input type="hidden" name="country_code" id="countryCode" value="+60">
                <input type="tel" class="form-control" name="phone_number" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
            </div>
            <small class="form-text text-muted">Used for order updates and delivery contact</small>
        </div>
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" rows="3" required></textarea>
            <small class="form-text text-muted">E.g. Unit/building name, street name</small>
        </div>
        <div class="form-group mb-3">
            <label for="postalCode">Postal Code</label>
            <input type="text" 
                   class="form-control" 
                   name="postal_code" 
                   pattern="[0-9]{5}"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                   maxlength="5"
                   required>
            <small class="form-text text-muted">Please enter your 5-digit postal code, e.g. 50050</small>
        </div>
        <div class="button-group">
            <button type="submit" name="save_address" class="btn btn-outline-danger" style="padding: 10px 20px !important; font-size: 16px !important;">Save Address</button>
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
    <!-- Begin: Deletion Confirmation Modal -->
  <div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
       background: rgba(0,0,0,0.6); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #fff; padding: 2.5rem; border-radius: 12px; width: 90%; max-width: 600px;
         text-align: left; position: relative; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
      <h4 style="font-size: 2rem; margin-bottom: 1.5rem; color: #333; font-weight: 600; text-align: left;">Remove address?</h4>
      <p id="deleteModalMsg" style="margin: 1.5rem 0; font-size: 1.4rem; color: #666; line-height: 1.6; text-align: left;"></p>
      <div style="margin-top: 2rem; display: flex; gap: 1.5rem; justify-content: flex-start;">
        <button id="confirmDeleteBtn" class="btn" style="
          background-color: #df0951;
          color: #FFFFFF;
          padding: 15px 30px;
          border-radius: 8px;
          border: none;
          font-size: 1.2rem;
          display: flex;
          align-items: center;
          gap: 10px;
          transition: all 0.2s ease;
        ">
          <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.2rem;"></i>
          Delete
        </button>
        <button id="cancelDeleteBtn" class="btn" style="
          background-color: #FFFFFF;
          color: #000000;
          padding: 15px 30px;
          border-radius: 8px;
          border: 1px solid #000000;
          font-size: 1.2rem;
          transition: all 0.2s ease;
        ">Cancel</button>
      </div>
    </div>
  </div>
  <!-- End: Deletion Confirmation Modal -->
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

document.querySelectorAll('.edit-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const card = btn.closest('.address-card');
    const editForm = card.querySelector('.edit-form');
    if (editForm.style.display === 'block') {
      editForm.style.display = 'none';
    } else {
      // Fill the form with existing data
      document.getElementById('addressId').value = card.dataset.id;
      document.querySelector('[name="full_name"]').value = card.dataset.full_name;
      document.getElementById('countryCode').value = card.dataset.country_code;
      document.getElementById('countryCodeBtn').textContent = ' ' + card.dataset.country_code + ' ';
      document.querySelector('[name="phone_number"]').value = card.dataset.phone_number;
      document.querySelector('[name="address"]').value = card.dataset.address;
      document.querySelector('[name="postal_code"]').value = card.dataset.postal_code;
      editForm.style.display = 'block';
    }
  });
});

// Assign a click handler to each "Cancel" button to close its form
document.querySelectorAll('.cancel-edit-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const editForm = btn.closest('.edit-form');
    editForm.style.display = 'none';
  });
});

const deleteModal = document.getElementById('deleteModal');
const deleteModalMsg = document.getElementById('deleteModalMsg');
const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

let targetCard = null; // to track which address card is being deleted

document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const card = btn.closest('.address-card');
    targetCard = card;
    const addressText = card.dataset.address;
    deleteModalMsg.textContent = `Your address at "${addressText}" will be permanently removed.`;
    deleteModal.style.display = 'flex';
  });
});

confirmDeleteBtn.addEventListener('click', () => {
  if (!targetCard) return;
  const addressId = targetCard.dataset.id;
  fetch('account.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
    body: new URLSearchParams({delete_address: addressId})
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      targetCard.remove();
    } else {
      alert('Error deleting address.');
    }
    deleteModal.style.display = 'none';
  })
  .catch(() => {
    alert('Error deleting address.');
    deleteModal.style.display = 'none';
  });
});

cancelDeleteBtn.addEventListener('click', () => {
  deleteModal.style.display = 'none';
});

// Add hover effects for the modal buttons
document.getElementById('confirmDeleteBtn').addEventListener('mouseenter', function() {
  this.style.backgroundColor = '#cb043c';
});
document.getElementById('confirmDeleteBtn').addEventListener('mouseleave', function() {
  this.style.backgroundColor = '#df0951';
});

document.getElementById('cancelDeleteBtn').addEventListener('mouseenter', function() {
  this.style.backgroundColor = '#F5F5F5';
});
document.getElementById('cancelDeleteBtn').addEventListener('mouseleave', function() {
  this.style.backgroundColor = '#FFFFFF';
});

// Add phone number validation
document.querySelectorAll('input[name="phone_number"]').forEach(input => {
    input.addEventListener('input', function(e) {
        // Remove any non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    input.addEventListener('invalid', function(e) {
        // Custom validation message
        if (this.validity.patternMismatch) {
            e.target.setCustomValidity('Please enter numbers only');
        } else {
            e.target.setCustomValidity('');
        }
    });
});

// Add postal code validation
document.querySelectorAll('input[name="postal_code"]').forEach(input => {
    input.addEventListener('input', function(e) {
        // Remove any non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Limit to 5 digits
        if (this.value.length > 5) {
            this.value = this.value.slice(0, 5);
        }
    });

    input.addEventListener('invalid', function(e) {
        if (this.validity.patternMismatch) {
            e.target.setCustomValidity('Please enter exactly 5 numbers');
        } else {
            e.target.setCustomValidity('');
        }
    });
});

// Update form submission validation to include postal code
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const phoneInput = this.querySelector('input[name="phone_number"]');
        const postalInput = this.querySelector('input[name="postal_code"]');
        
        if (phoneInput && !/^[0-9]+$/.test(phoneInput.value)) {
            e.preventDefault();
            alert('Phone number must contain only numbers');
            return;
        }
        
        if (postalInput && !/^[0-9]{5}$/.test(postalInput.value)) {
            e.preventDefault();
            alert('Postal code must contain exactly 5 numbers');
            return;
        }
    });
});

function toggleProfileEdit() {
    const form = document.querySelector('.edit-profile-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

document.querySelector('.profile-card .btn-outline-danger').addEventListener('click', toggleProfileEdit);

document.getElementById('profileEditForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const emailInput = this.querySelector('[name="email"]');
    if (!emailInput.checkValidity()) {
        alert('Please enter a valid email address');
        return;
    }

    fetch('account.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            update_profile: true,
            full_name: this.querySelector('[name="full_name"]').value,
            email: emailInput.value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update profile card
            const name = this.querySelector('[name="full_name"]').value;
            const email = this.querySelector('[name="email"]').value;
            
            // Update profile card
            document.querySelector('.profile-card .card-title').textContent = name;
            document.querySelector('.profile-card .card-text').textContent = email;
            
            // Update personal details tab
            document.querySelector('.personal-info-section .user-name').textContent = name;
            document.querySelector('.personal-info-section .user-email').textContent = email;
            
            // Update initials
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
            document.querySelector('.profile-initials').textContent = initials;
            
            toggleProfileEdit(); // Hide form
        } else {
            alert(data.message || 'Error updating profile');
        }
    })
    .catch(error => {
        alert('Error updating profile');
        console.error('Error:', error);
    });
});
</script>
<style>
.personal-info-section {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.info-group {
    margin-bottom: 15px;
    display: flex;
    align-items: baseline;
}

.info-group label {
    font-weight: 600;
    min-width: 120px;
    color: #333;
}

.info-group span {
    color: #666;
    font-size: 1.1em;
}
</style>
</body>
</html>

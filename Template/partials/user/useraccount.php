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
?>

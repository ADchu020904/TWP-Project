<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: admin-login.html?error=Please log in first");
    exit();
}
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: usersignup.php");
    exit();
}

// Fetch staff data
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT id, name, email, position, department, description, phone_number FROM staff WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();

// Handle staff information update
if(isset($_POST['update_staff'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $description = $_POST['description'];
    $phone_number = $_POST['phone_number'];

    $stmt = $conn->prepare("UPDATE staff SET name = ?, email = ?, position = ?, department = ?, description = ?, phone_number = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $name, $email, $position, $department, $description, $phone_number, $staff['id']);
    $stmt->execute();
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
   <title>Staff Account</title>
   <!-- Style -->
   <?php include 'partials/user/userstyle.html'; ?>
   <style>
   /* Specific to account page */
    .header_section {
        margin-bottom: 30px !important;
    }
    </style>
</head>
<!-- header section start -->
 <?php include 'partials/user/userheader.html'; ?>    
    <!-- account section start -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card">
                    <?php
                    $initials = strtoupper(substr($staff['name'], 0, 1));
                    ?>
                    <div class="profile-initials"><?php echo htmlspecialchars($initials); ?></div>
                    <h5 class="card-title"><?php echo htmlspecialchars($staff['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($staff['email']); ?></p>
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
                        <form method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($staff['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($staff['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" name="position" value="<?php echo htmlspecialchars($staff['position']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($staff['department']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($staff['phone_number']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="4" required><?php echo htmlspecialchars($staff['description']); ?></textarea>
                            </div>
                            <button type="submit" name="update_staff" class="btn btn-outline-danger">Update Details</button>
                        </form>
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
    <?php include 'partials/user/userfooter.html'; ?>
    <!-- footer section end -->
</body>
</html>
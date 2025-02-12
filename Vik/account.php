<?php include 'partials/user/useraccount.php'; ?>

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
   <?php include "partials/user/userstyle.html"; ?>
</head>
<body>
 <!-- Header Section -->
 <?php include 'partials/user/userheader.html'; ?>
<!-- End Header Section --> 

<style>
    /* Specific to account page */
    .header_section {
        margin-bottom: 30px !important;
    }
    
</style>

  <!-- account section start -->
  <div class="container ">
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
   <?php include 'partials/user/userfooter.html'; ?>
   <!-- footer section end -->
   
</style>
</body>
</html>

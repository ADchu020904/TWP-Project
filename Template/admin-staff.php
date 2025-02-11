<?php
include 'partials/staff/staffinfo.php';
// Delete Staff
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM staff WHERE id=$id") or die($conn->error);
  header("Location: admin-staff.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Staff Management</title>
  <?php include 'partials/style.html'; ?>
</head>
<body x-data="{ page: 'settings', loaded: true, darkMode: true, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
  x-init="
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
  
  <!-- Layout Container -->
  <div class="dashboard-container">
    <!-- Sidebar Start -->
    <?php include 'partials/sidebar.html'; ?>
    <!-- Sidebar Finish -->

    <!-- Navbar Start -->
    <?php include 'partials/header.php'; ?>
    <!-- Navbar Finish -->


    <!-- Main Content Start -->
    <!-- View Staff Section -->
    <div class="main-content" id="view">
      <h1 class="h1">View Staff</h1>
      <a href="#" class="add-btn" onclick="setSection('add')">Add Staff</a>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Department</th>
            <th>Position</th>
            <th>Bio</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id, name, phone_number, email, position, department, bio FROM staff";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['name']}</td>
              <td>{$row['phone_number']}</td>
              <td>{$row['email']}</td>              
              <td>{$row['department']}</td>
              <td>{$row['position']}</td>
              <td>{$row['bio']}</td>
              <td>
                <a href='partials/staff/updatestaff.php?id={$row['id']}' class='edit-btn'>Edit</a>
                <a href='partials/staff/deletestaffphp?delete={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this staff?\");'>Delete</a>
              </td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Add Staff Section -->
    <div class="main-content" id="add" style="display: none;">
      <h1 class="h1">Add Staff</h1>
      <form method="POST" action="partials/staff/addstaff.php" enctype="multipart/form-data">
        <label class="label" for="staff-name">Name</label>
        <input type="text" class="member-form-input" id="staff-name" name="name" required>
        
        <label class="label" for="staff-phone">Phone Number</label>
        <input type="text" class="member-form-input" id="staff-phone" name="phone_number" required>
        
        <label class="label" for="staff-email">Email</label>
        <input type="email" class="member-form-input" id="staff-email" name="email" required>
        
        <label class="label" for="staff-department">Department</label>
        <input type="text" class="member-form-input" id="staff-department" name="department" required>
        
        <label class="label" for="staff-position">Position</label>
        <input type="text" class="member-form-input" id="staff-position" name="position" required>
        
        <label class="label" for="staff-bio">Bio</label>
        <textarea id="staff-bio" class="member-form-input" name="bio" rows="4" required></textarea>
        
        <label class="label" for="staff-password">Password</label>
        <input type="password" class="member-form-input" id="staff-password" name="password" required>
        
        <label class="label" for="staff-photo">Photo</label>
        <input type="file" class="member-form-input" id="staff-photo" name="photo" accept="image/*">
        
        <button class="member-form-button" type="submit">Add Staff</button>
      </form>
    </div>

    <!-- Update Staff Section -->
    <div class="main-content" id="update" style="display: none;">
      <h1 class="h1">Update Staff</h1>
      <form method="POST" action="partials/staff/updatestaff.php" enctype="multipart/form-data">
        <label class="label" for="update-staff-select">Select Staff to Update</label>
        <select id="update-staff-select" name="id" required onchange="loadStaffData(this.value)">
          <option value="">Select a staff member</option>
          <?php
          $sql = "SELECT id, name FROM staff";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
          }
          ?>
        </select>
        
        <label class="label" for="update-staff-name">Name</label>
        <input type="text" class="member-form-input" id="update-staff-name" name="name" required>
        
        <label class="label" for="update-staff-phone">Phone Number</label>
        <input type="text" class="member-form-input" id="update-staff-phone" name="phone_number" required>
        
        <label class="label" for="update-staff-email">Email</label>
        <input type="email" class="member-form-input" id="update-staff-email" name="email" required>
        
        <label class="label" for="update-staff-department">Department</label>
        <input type="text" class="member-form-input" id="update-staff-department" name="department" required>
        
        <label class="label" for="update-staff-position">Position</label>
        <input type="text" class="member-form-input" id="update-staff-position" name="position" required>
        
        <label class="label" for="update-staff-bio">Bio</label>
        <textarea id="update-staff-bio" class="member-form-input" name="bio" rows="4" required></textarea>
        
        <label class="label" for="update-staff-password">Password (leave blank to keep unchanged)</label>
        <input type="password" class="member-form-input" id="update-staff-password" name="password">
        
        <label class="label" for="update-staff-photo">Photo (optional)</label>
        <input type="file" class="member-form-input" id="update-staff-photo" name="photo" accept="image/*">
        
        <button class="member-form-button" type="submit">Update Staff</button>
      </form>
      <script>
        function loadStaffData(staffId) {
          if (!staffId) return;
          fetch('partials/staff/getstaffdata.php?id=' + staffId)
            .then(response => response.json())
            .then(data => {
              if (!data) return;
              document.getElementById('update-staff-name').value = data.name;
              document.getElementById('update-staff-phone').value = data.phone_number;
              document.getElementById('update-staff-email').value = data.email;
              document.getElementById('update-staff-position').value = data.position;
              document.getElementById('update-staff-department').value = data.department;
              document.getElementById('update-staff-bio').value = data.bio;
            })
            .catch(err => console.error('Error:', err));
        }
      </script>
    </div>

    <!-- Delete Staff Section -->
    <div class="main-content" id="delete" style="display: none;">
      <h1 class="h1">Delete Staff</h1>
      <form method="POST" action="partials/staff/deletestaff.php">
        <label class="label" for="delete-staff-select">Select Staff to Delete</label>
        <select id="delete-staff-select" name="id" required>
          <option value="">Select a staff member</option>
          <?php
          $sql = "SELECT id, name FROM staff";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
          }
          ?>
        </select>
        <button class="member-form-button" type="submit">Delete Staff</button>
      </form>
    </div>

  </div>
  <!-- Main Content Finish -->
   <?php include 'partials/js.html'; ?>
</body>
</html>
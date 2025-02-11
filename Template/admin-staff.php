<?php
include 'partials/staffinfo.php';
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
    <?php include 'partials/header.html'; ?>
    <!-- Navbar Finish -->

    <!-- Main Content Start -->
    <div class="main-content" id="view">
      <h1 class="h1 dark:text-white">View Staff</h1>
      <a href="#" class="add-btn" onclick="setSection('add')">Add Staff</a>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Position</th>
            <th>Department</th>
            <th>Bio</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id, name, phone_number, email, position, department, bio FROM staff";
          $result = $conn->query($sql);
          if ($result) {
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                  <td>{$row['name']}</td>
                  <td>{$row['phone_number']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['position']}</td>
                  <td>{$row['department']}</td>
                  <td>" . nl2br(htmlspecialchars($row['bio'])) . "</td>
                  <td>
                    <a href='#' onclick=\"populateUpdateForm({$row['id']}, '{$row['name']}', '{$row['phone_number']}', '{$row['email']}', '{$row['position']}', '{$row['department']}', '{$row['bio']}')\">Edit</a> | 
                    <a href='#' onclick=\"populateDeleteForm({$row['id']}, '{$row['name']}')\">Delete</a>
                  </td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='7'>No staff members found</td></tr>";
            }
          } else {
            echo "<tr><td colspan='7'>Error: " . $conn->error . "</td></tr>";
          }
          ?>        
        </tbody>
      </table>
    </div>

    <!-- Add Staff Section -->
    <div class="main-content" id="add" style="display: none;">
      <h1 class="h1 dark:text-white">Add Staff Member</h1>
      <form method="POST" action="partials/addstaff.php" enctype="multipart/form-data">
        <label class="label dark:text-white" for="staff-name">Name</label>
        <input type="text" class="member-form-input" id="staff-name" name="name" required>
        
        <label class="label dark:text-white" for="staff-phone">Phone Number</label>
        <input type="text" class="member-form-input" id="staff-phone" name="phone_number" required>
        
        <label class="label dark:text-white" for="staff-email">Email</label>
        <input type="email" class="member-form-input" id="staff-email" name="email" required>
        
        <label class="label dark:text-white" for="staff-position">Position</label>
        <input type="text" class="member-form-input" id="staff-position" name="position" required>
        
        <label class="label dark:text-white" for="staff-department">Department</label>
        <input type="text" class="member-form-input" id="staff-department" name="department" required>
        
        <label class="label dark:text-white" for="staff-bio">Bio</label>
        <textarea id="staff-bio" class="member-form-input" name="bio" rows="4" required></textarea>
        
        <label class="label dark:text-white" for="staff-password">Password</label>
        <input type="password" class="member-form-input" id="staff-password" name="password" required>
        
        <label class="label dark:text-white" for="staff-photo">Photo</label>
        <input type="file" class="member-form-input" id="staff-photo" name="photo" accept="image/*">
        
        <button class="member-form-button" type="submit">Add Staff</button>
      </form>
    </div>

    <!-- Update Staff Section -->
    <div class="main-content" id="update" style="display: none;">
      <h1 class="h1 dark:text-white">Update Staff</h1>
      <form method="POST" action="partials/updatestaff.php" enctype="multipart/form-data">
        <label class="label dark:text-white" for="update-staff-select">Select Staff to Update</label>
        <select id="update-staff-select" name="id" required>
          <!-- Options will be loaded dynamically -->
        </select>
        
        <label class="label dark:text-white" for="update-staff-name">Name</label>
        <input type="text" class="member-form-input" id="update-staff-name" name="name" required>
        
        <label class="label dark:text-white" for="update-staff-phone">Phone Number</label>
        <input type="text" class="member-form-input" id="update-staff-phone" name="phone_number" required>
        
        <label class="label dark:text-white" for="update-staff-email">Email</label>
        <input type="email" class="member-form-input" id="update-staff-email" name="email" required>
        
        <label class="label dark:text-white" for="update-staff-position">Position</label>
        <input type="text" class="member-form-input" id="update-staff-position" name="position" required>
        
        <label class="label dark:text-white" for="update-staff-department">Department</label>
        <input type="text" class="member-form-input" id="update-staff-department" name="department" required>
        
        <label class="label dark:text-white" for="update-staff-bio">Bio</label>
        <textarea id="update-staff-bio" class="member-form-input" name="bio" rows="4" required></textarea>
        
        <label class="label dark:text-white" for="update-staff-password">Password (leave blank to keep unchanged)</label>
        <input type="password" class="member-form-input" id="update-staff-password" name="password">
        
        <label class="label dark:text-white" for="update-staff-photo">Photo (optional)</label>
        <input type="file" class="member-form-input" id="update-staff-photo" name="photo" accept="image/*">
        
        <button class="member-form-button" type="submit">Update Staff</button>
      </form>
    </div>

    <!-- Delete Staff Section -->
    <div class="main-content" id="delete" style="display: none;">
      <h1 class="h1 dark:text-white">Delete Staff</h1>
      <form method="POST" action="partials/deletestaff.php">
        <label class="label dark:text-white" for="delete-staff-select">Select Staff to Delete</label>
        <select id="delete-staff-select" name="id" required>
          <!-- Options will be loaded dynamically -->
        </select>
        <button class="member-form-button" type="submit">Delete Staff</button>
      </form>
    </div>
    <!-- Main Content End -->
  </div>

  <?php include 'partials/js.html'; ?>
  <script>
    function setSection(section) {
      // Hide all sections
      document.getElementById('view').style.display = 'none';
      document.getElementById('add').style.display = 'none';
      document.getElementById('update').style.display = 'none';
      document.getElementById('delete').style.display = 'none';
      // Show the selected section
      document.getElementById(section).style.display = 'block';
      window.location.hash = section;
    }

    function populateUpdateForm(id, name, phone_number, email, position, department, bio) {
      document.getElementById('update').style.display = 'block';
      document.getElementById('update-staff-select').value = id;
      document.getElementById('update-staff-name').value = name;
      document.getElementById('update-staff-phone').value = phone_number;
      document.getElementById('update-staff-email').value = email;
      document.getElementById('update-staff-position').value = position;
      document.getElementById('update-staff-department').value = department;
      document.getElementById('update-staff-bio').value = bio;
    }

    function populateDeleteForm(id, name) {
      document.getElementById('delete').style.display = 'block';
      document.getElementById('delete-staff-select').value = id;
    }
  </script>
</body>
</html>

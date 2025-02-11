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
        <select id="staff-department" name="department" class="member-form-input" onchange="updatePositions('staff-department','staff-position')">
          <option value="">Select Department</option>
          <option value="Sales">Sales</option>
          <option value="Customer Service">Customer Service</option>
          <option value="Operations">Operations</option>
          <option value="Design & Development">Design & Development</option>
          <option value="Marketing">Marketing</option>
          <option value="Finance/Administration">Finance/Administration</option>
          <option value="IT">IT</option>
        </select>
        
        <label class="label" for="staff-position">Position</label>
        <select id="staff-position" name="position" class="member-form-input">
          <option value="">Select Position</option>
        </select>
        
        <label class="label" for="staff-bio">Bio</label>
        <textarea id="staff-bio" class="member-form-input" name="bio" rows="4" required></textarea>
        
        <label class="label" for="staff-password">Password</label>
        <input type="password" class="member-form-input" id="staff-password" name="password" required>
        
        <label class="label" for="staff-photo">Photo</label>
        <input type="file" class="member-form-input" id="staff-photo" name="photo" accept="image/*">
        
        <button class="member-form-button" type="submit">Add Staff</button>
        <button type="submit" class="save-btn">Submit</button>
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
        <select id="update-staff-department" name="department" class="member-form-input" required onchange="updatePositions('update-staff-department','update-staff-position')">
          <option value="">Select Department</option>
          <option value="Sales">Sales</option>
          <option value="Customer Service">Customer Service</option>
          <option value="Operations">Operations</option>
          <option value="Design & Development">Design & Development</option>
          <option value="Marketing">Marketing</option>
          <option value="Finance/Administration">Finance/Administration</option>
          <option value="IT">IT</option>
        </select>
        
        <label class="label" for="update-staff-position">Position</label>
        <select id="update-staff-position" name="position" class="member-form-input" required>
          <option value="">Select Position</option>
        </select>
        
        <label class="label" for="update-staff-bio">Bio</label>
        <textarea id="update-staff-bio" class="member-form-input" name="bio" rows="4" required></textarea>
        
        <label class="label" for="update-staff-password">Password (leave blank to keep unchanged)</label>
        <input type="password" class="member-form-input" id="update-staff-password" name="password">
        
        <label class="label" for="update-staff-photo">Photo (optional)</label>
        <input type="file" class="member-form-input" id="update-staff-photo" name="photo" accept="image/*">
        
        <button class="member-form-button" type="submit">Update Staff</button>
        <button type="submit" class="save-btn">Submit</button>
      </form>
      <script>
        function loadStaffData(staffId) {
          if (!staffId) return;
          fetch('partials/staff/getstaffdata.php?id=' + staffId)
            .then(response => response.json())
            .then(data => {
              if (!data) return;
              // Set basic field values
              document.getElementById('update-staff-name').value = data.name;
              document.getElementById('update-staff-phone').value = data.phone_number;
              document.getElementById('update-staff-email').value = data.email;
              document.getElementById('update-staff-bio').value = data.bio;
              
              // Set department and trigger position update
              const deptSelect = document.getElementById('update-staff-department');
              deptSelect.value = data.department;
              
              // Update positions dropdown and set saved position
              updatePositions('update-staff-department', 'update-staff-position');
              
              // Set the position after a small delay to ensure positions are populated
              setTimeout(() => {
                const posSelect = document.getElementById('update-staff-position');
                posSelect.value = data.position;
              }, 100);
            })
            .catch(err => console.error('Error:', err));
        }

        const departmentPositions = {
    "Sales": [
      "Store Manager",
      "Sales Executive",
      "Sales Assistant",
      "Business Development Executive",
      "Account Manager"
    ],
    "Customer Service": [
      "Customer Service Representative",
      "Support Specialist",
      "Returns & Exchanges Coordinator",
      "Online Chat Specialist",
      "After-Sales Support Specialist"
    ],
    "Operations": [
      "Warehouse Manager",
      "Inventory Coordinator",
      "Logistics Supervisor",
      "Shipping & Receiving Clerk",
      "Operations Analyst"
    ],
    "Design & Development": [
      "Product Designer",
      "Industrial Designer",
      "CAD Specialist",
      "Prototype Engineer",
      "R&D Manager"
    ],
    "Marketing": [
      "Marketing Manager",
      "Social Media Specialist",
      "Visual Merchandiser",
      "Content Creator",
      "Brand Strategist"
    ],
    "Finance/Administration": [
      "Accountant",
      "Financial Analyst",
      "Bookkeeper",
      "Administrative Assistant",
      "HR Manager"
    ],
    "IT": [
      "IT Manager",
      "Software Developer",
      "Web Developer",
      "Network Administrator",
      "Technical Support Specialist"
    ]
  };

  function updatePositions(deptSelectId, positionSelectId) {
    const dept = document.getElementById(deptSelectId).value;
    const posSelect = document.getElementById(positionSelectId);
    const currentPosition = posSelect.value; // Store current position before clearing
    
    // Clear existing options
    posSelect.innerHTML = '<option value="">Select Position</option>';
    
    // If there's a matching department, populate its positions
    if (departmentPositions[dept]) {
      departmentPositions[dept].forEach(pos => {
        const option = document.createElement('option');
        option.value = pos;
        option.textContent = pos;
        // Select if it matches the current position
        if (pos === currentPosition) {
          option.selected = true;
        }
        posSelect.appendChild(option);
      });
    }
  }

  // On page load, trigger it once so position is pre-filled if editing
  window.addEventListener('DOMContentLoaded', () => {
    updatePositions('departmentSelect','positionSelect');
  });
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
        <button type="submit" class="save-btn">Confirm Delete</button>
      </form>
    </div>

  </div>
  <!-- Main Content Finish -->
   <?php include 'partials/js.html'; ?>
</body>
</html>
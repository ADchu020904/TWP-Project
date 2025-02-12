<?php

// If "delete" is triggered by URL param ?delete=ID
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM staff WHERE id=$id") or die($conn->error);
    header("Location: admin-staff.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Staff Management</title>
  <?php include 'partials/style.html'; ?>
</head>
<body
  x-data="{ page: 'staff', loaded: true, darkMode: true, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
  x-init="
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
>
<div class="dashboard-container">
  <!-- ===== Sidebar Start ===== -->
  <?php include 'partials/sidebar.html'; ?>
  <!-- ===== Sidebar End ===== -->

  <!-- ===== Header Start ===== -->
  <?php include 'partials/header.php'; ?>
  <!-- ===== Header End ===== -->

  <!-- Main Content Start -->
  <div class="main-content p-4">

    <!-- ============== VIEW STAFF SECTION ============== -->
    <div id="view">
      <h1 class="text-xl font-bold mb-4">View Staff</h1>
      <a href="#" class="add-btn" onclick="setSection('add')">Add Staff</a>
      <table class="w-full border-collapse mt-4">
        <thead>
          <tr class="border-b border-gray-300">
            <th class="p-2 text-left">Name</th>
            <th class="p-2 text-left">Phone Number</th>
            <th class="p-2 text-left">Email</th>
            <th class="p-2 text-left">Department</th>
            <th class="p-2 text-left">Position</th>
            <th class="p-2 text-left">Bio</th>
            <th class="p-2 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql    = "SELECT id, name, phone_number, email, position, department, bio FROM staff";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()) {
              ?>
              <tr class="border-b border-gray-200">
                <td class="p-2"><?php echo htmlspecialchars($row['name']); ?></td>
                <td class="p-2"><?php echo htmlspecialchars($row['phone_number']); ?></td>
                <td class="p-2"><?php echo htmlspecialchars($row['email']); ?></td>
                <td class="p-2"><?php echo htmlspecialchars($row['department']); ?></td>
                <td class="p-2"><?php echo htmlspecialchars($row['position']); ?></td>
                <td class="p-2"><?php echo htmlspecialchars($row['bio']); ?></td>
                <td class="p-2 flex gap-2">
                  <!-- "Edit" calls the Update Staff section below, passing ?edit=ID -->
                  <a 
                    href="#" 
                    onclick="setSection('update', <?php echo $row['id']; ?>)" 
                    class="edit-btn bg-green-500 text-white px-2 py-1 rounded"
                  >
                    Edit
                  </a>
                  <!-- "Delete" triggers ?delete=ID on this same page -->
                  <a
                    href="?delete=<?php echo $row['id']; ?>"
                    class="delete-btn bg-red-500 text-white px-2 py-1 rounded"
                    onclick="return confirm('Are you sure you want to delete this staff?');"
                  >
                    Delete
                  </a>
                </td>
              </tr>
              <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- ============== /VIEW STAFF SECTION ============== -->


    <!-- ============== ADD STAFF SECTION ============== -->
    <div id="add" style="display: none;">
      <h1 class="text-xl font-bold mb-4">Add Staff</h1>
      <form method="POST" action="partials/staff/addstaff.php" enctype="multipart/form-data">
        <label for="staff-name" class="block mb-1 font-semibold">Name</label>
        <input type="text" class="member-form-input mb-3" id="staff-name" name="name" required>
        
        <label for="staff-phone" class="block mb-1 font-semibold">Phone Number</label>
        <input type="text" class="member-form-input mb-3" id="staff-phone" name="phone_number" required>
        
        <label for="staff-email" class="block mb-1 font-semibold">Email</label>
        <input type="email" class="member-form-input mb-3" id="staff-email" name="email" required>
        
        <label for="staff-department" class="block mb-1 font-semibold">Department</label>
        <select 
          id="staff-department" 
          name="department" 
          class="member-form-input mb-3" 
          onchange="updatePositions('staff-department','staff-position')"
        >
          <option value="">Select Department</option>
          <option value="Sales">Sales</option>
          <option value="Customer Service">Customer Service</option>
          <option value="Operations">Operations</option>
          <option value="Design & Development">Design & Development</option>
          <option value="Marketing">Marketing</option>
          <option value="Finance/Administration">Finance/Administration</option>
          <option value="IT">IT</option>
        </select>
        
        <label for="staff-position" class="block mb-1 font-semibold">Position</label>
        <select id="staff-position" name="position" class="member-form-input mb-3">
          <option value="">Select Position</option>
        </select>
        
        <label for="staff-bio" class="block mb-1 font-semibold">Bio</label>
        <textarea id="staff-bio" class="member-form-input mb-3" name="bio" rows="4" required></textarea>
        
        <label for="staff-password" class="block mb-1 font-semibold">Password</label>
        <input type="password" class="member-form-input mb-3" id="staff-password" name="password" required>
        
        <label for="staff-photo" class="block mb-1 font-semibold">Photo</label>
        <input type="file" class="member-form-input mb-3" id="staff-photo" name="photo" accept="image/*">
        
        <button type="submit" class="member-form-button">Add Staff</button>
        <button type="button" class="save-btn ml-2" onclick="setSection('view')">Cancel</button>
      </form>
    </div>
    <!-- ============== /ADD STAFF SECTION ============== -->


    <!-- ============== UPDATE STAFF SECTION ============== -->
    <div id="update" style="display: none;">
      <h1 class="text-xl font-bold mb-4">Update Staff</h1>
      
      <!-- Add staff selection dropdown -->
      <div class="mb-4">
        <label for="select-staff" class="block mb-2 text-sm font-semibold text-black dark:text-white">
          Select Staff Member to Update
        </label>
        <select id="select-staff" 
                class="w-full rounded-lg border border-stroke bg-gray px-4 py-2 dark:border-strokedark dark:bg-boxdark"
                onchange="handleStaffSelect(this.value)">
          <option value="">Select a staff member</option>
          <?php
          $staff_sql = "SELECT id, name FROM staff ORDER BY name";
          $staff_result = $conn->query($staff_sql);
          while ($staff_row = $staff_result->fetch_assoc()) {
              echo "<option value='" . $staff_row['id'] . "'>" . 
                   htmlspecialchars($staff_row['name']) . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Update form -->
      <form 
        id="updateForm"
        method="POST" 
        action="partials/staff/updatestaff.php" 
        enctype="multipart/form-data"
      >
        <!-- This hidden "id" will store the staff ID we want to update -->
        <input type="hidden" id="update-staff-id" name="id" value="">

        <label for="update-staff-name" class="block mb-1 font-semibold">Name</label>
        <input type="text" class="member-form-input mb-3" id="update-staff-name" name="name" required>
        
        <label for="update-staff-phone" class="block mb-1 font-semibold">Phone Number</label>
        <input type="text" class="member-form-input mb-3" id="update-staff-phone" name="phone_number" required>
        
        <label for="update-staff-email" class="block mb-1 font-semibold">Email</label>
        <input type="email" class="member-form-input mb-3" id="update-staff-email" name="email" required>
        
        <label for="update-staff-department" class="block mb-1 font-semibold">Department</label>
        <select 
          id="update-staff-department" 
          name="department" 
          class="member-form-input mb-3" 
          onchange="updatePositions('update-staff-department','update-staff-position')"
          required
        >
          <option value="">Select Department</option>
          <option value="Sales">Sales</option>
          <option value="Customer Service">Customer Service</option>
          <option value="Operations">Operations</option>
          <option value="Design & Development">Design & Development</option>
          <option value="Marketing">Marketing</option>
          <option value="Finance/Administration">Finance/Administration</option>
          <option value="IT">IT</option>
        </select>
        
        <label for="update-staff-position" class="block mb-1 font-semibold">Position</label>
        <select id="update-staff-position" name="position" class="member-form-input mb-3" required>
          <option value="">Select Position</option>
        </select>
        
        <label for="update-staff-bio" class="block mb-1 font-semibold">Bio</label>
        <textarea id="update-staff-bio" class="member-form-input mb-3" name="bio" rows="4" required></textarea>
        
        <label for="update-staff-password" class="block mb-1 font-semibold">
          Password (leave blank to keep unchanged)
        </label>
        <input type="password" class="member-form-input mb-3" id="update-staff-password" name="password">
        
        <label for="update-staff-photo" class="block mb-1 font-semibold">Photo (optional)</label>
        <input type="file" class="member-form-input mb-3" id="update-staff-photo" name="photo" accept="image/*">
        
        <button type="submit" class="member-form-button">Update Staff</button>
        <button type="button" class="save-btn ml-2" onclick="setSection('view')">Cancel</button>
      </form>
    </div>
    <!-- ============== /UPDATE STAFF SECTION ============== -->


    <!-- ============== DELETE STAFF SECTION ============== -->
    <div id="delete" style="display: none;">
      <h1 class="text-xl font-bold mb-4">Delete Staff</h1>
      <form method="POST" action="partials/staff/deletestaff.php">
        <label class="block mb-1 font-semibold" for="delete-staff-select">Select Staff to Delete</label>
        <select id="delete-staff-select" name="id" class="member-form-input mb-3" required>
          <option value="">Select a staff member</option>
          <?php
          // Populate the staff list in the "delete" section
          $sql2 = "SELECT id, name FROM staff";
          $res2 = $conn->query($sql2);
          while ($r = $res2->fetch_assoc()) {
              echo "<option value='" . $r['id'] . "'>" . htmlspecialchars($r['name']) . "</option>";
          }
          ?>
        </select>
        <button class="member-form-button" type="submit">Delete Staff</button>
        <button type="button" class="save-btn ml-2" onclick="setSection('view')">Cancel</button>
      </form>
    </div>
    <!-- ============== /DELETE STAFF SECTION ============== -->

  </div>
  <!-- Main Content End -->
</div>

<?php include 'partials/js.html'; ?>

<script>
// Department -> Position data
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

// Show/hide sections, optionally load staff data for "update"
function setSection(section, staffId = 0) {
  // Hide all sections
  document.getElementById('view').style.display   = 'none';
  document.getElementById('add').style.display    = 'none';
  document.getElementById('update').style.display = 'none';
  document.getElementById('delete').style.display = 'none';

  if (section === 'view') {
    document.getElementById('view').style.display = 'block';
    return;
  }
  if (section === 'add') {
    document.getElementById('add').style.display = 'block';
    return;
  }
  if (section === 'delete') {
    document.getElementById('delete').style.display = 'block';
    return;
  }
  if (section === 'update') {
    // Show the update form
    document.getElementById('update').style.display = 'block';
    // Load staff data
    if (staffId > 0) {
      document.getElementById('select-staff').value = staffId;
      handleStaffSelect(staffId);
    }
    return;
  }
}

// AJAX call to get staff data by ID, then fill form
function loadStaffData(staffId) {
  if (!staffId) return; // Don't proceed if no staff selected

  fetch('partials/staff/getstaffdata.php?id=' + staffId)
    .then(response => response.json())
    .then(data => {
      if (!data) return;

      // Fill fields
      document.getElementById('update-staff-id').value    = data.id;
      document.getElementById('update-staff-name').value  = data.name;
      document.getElementById('update-staff-phone').value = data.phone_number;
      document.getElementById('update-staff-email').value = data.email;
      document.getElementById('update-staff-bio').value   = data.bio;

      // Department
      const deptSelect = document.getElementById('update-staff-department');
      deptSelect.value = data.department || '';

      // Trigger position dropdown
      updatePositions('update-staff-department','update-staff-position');

      // Position
      setTimeout(()=>{
        const posSelect = document.getElementById('update-staff-position');
        posSelect.value = data.position || '';
      }, 100);

    })
    .catch(err => console.error('Error loading staff data:', err));
}

// This function updates the relevant position <select> given a department
function updatePositions(deptSelectId, positionSelectId) {
  const deptValue = document.getElementById(deptSelectId).value;
  const posSelect = document.getElementById(positionSelectId);

  // Clear existing
  posSelect.innerHTML = '<option value="">Select Position</option>';

  if (departmentPositions[deptValue]) {
    departmentPositions[deptValue].forEach(pos => {
      let opt = document.createElement('option');
      opt.value = pos;
      opt.textContent = pos;
      posSelect.appendChild(opt);
    });
  }
}

// New function to handle staff selection
function handleStaffSelect(staffId) {
    if (!staffId) {
        document.getElementById('updateForm').reset();
        return;
    }

    fetch(`partials/staff/getstaffdata.php?id=${staffId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Fill form fields
            document.getElementById('update-staff-id').value = data.id;
            document.getElementById('update-staff-name').value = data.name;
            document.getElementById('update-staff-phone').value = data.phone_number;
            document.getElementById('update-staff-email').value = data.email;
            document.getElementById('update-staff-bio').value = data.bio;

            // Handle department and position
            const deptSelect = document.getElementById('update-staff-department');
            deptSelect.value = data.department;
            
            // Update positions dropdown
            updatePositions('update-staff-department', 'update-staff-position');
            
            // Set position after a brief delay to ensure positions are populated
            setTimeout(() => {
                const posSelect = document.getElementById('update-staff-position');
                posSelect.value = data.position;
            }, 100);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading staff data');
        });
}

// By default show "view" section
setSection('view');
</script>
</body>
</html>

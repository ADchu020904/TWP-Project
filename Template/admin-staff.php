<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staff Management</title>
    <?php include 'partials/style.html'; ?>
</head>
<body x-data ="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
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
                        <th>Email</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic content will be loaded here -->
                </tbody>
            </table>
        </div>

        <div class="main-content" id="add" style="display: none;">
            <h1 class="h1 dark:text-white">Add Staff Member</h1>
            <form method="POST" action="addstaff.php">
                <label class="label dark:text-white" for="staff-name">Name</label>
                <input type="text" class="member-form-input" id="staff-name" name="name">
                <label class="label dark:text-white" for="staff-email">Email</label>
                <input type="email" class="member-form-input" id="staff-email" name="email">
                <label class="label dark:text-white" for="staff-position">Position</label>
                <input type="text" class="member-form-input" id="staff-position" name="position">
                <label class="label dark:text-white" for="staff-department">Department</label>
                <input type="text" class="member-form-input" id="staff-department" name="department">
                <label class="label dark:text-white" for="staff-description">Description</label>
                <textarea id="staff-description" class="member-form-input" name="description" rows="4"></textarea>
                <input type="file" name="image" id="staff-image">
                <button class="member-form-button" type="submit">Add Staff</button>
            </form>
        </div>

        <div class="main-content" id="update" style="display: none;">
            <h1 class="h1 dark:text-white">Update Staff</h1>
            <form>
                <label class="label dark:text-white" for="update-staff-select">Select Staff to Update</label>
                <select id="update-staff-select" name="id" required>
                    <!-- Options will be loaded dynamically -->
                </select>
                <label class="label dark:text-white" for="staff-name">Name</label>
                <input type="text" class="member-form-input" id="staff-name" name="name" required>
                <label class="label dark:text-white" for="staff-email">Email</label>
                <input type="email" class="member-form-input" id="staff-email" name="email" required>
                <label class="label dark:text-white" for="staff-position">Position</label>
                <input type="text" class="member-form-input" id="staff-position" name="position" required>
                <label class="label dark:text-white" for="staff-department">Department</label>
                <input type="text" class="member-form-input" id="staff-department" name="department" required>
                <label class="label dark:text-white" for="staff-description">Description</label>
                <textarea id="staff-description" class="member-form-input" name="description" rows="4" required></textarea>
                <button class="member-form-button" type="submit">Update Staff</button>
            </form>
        </div>

        <div class="main-content" id="delete" style="display: none;">
            <h1 class="h1 dark:text-white">Delete Staff</h1>
            <form method="POST" action="deletestaff.php">
                <label class="label dark:text-white" for="delete-staff-select">Select Staff to Delete</label>
                <select id="delete-staff-select" name="id" required>
                    <!-- Options will be loaded dynamically -->
                </select>
                <button class="member-form-button" type="submit">Delete Staff</button>
            </form>
        </div>
    </div>
    <?php include 'partials/js.html'; ?>
</body>
</html>
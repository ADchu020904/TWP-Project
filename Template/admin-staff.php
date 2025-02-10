<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staff Management</title>
    <?php include 'partials/style.html'; ?>
</head>
<body class="bg-body-secondary">
    <!-- Layout Container -->
    <div class="dashboard-container">
        <!-- Sidebar Start -->
        <div class="sidebar sidebar-dark border-end">
            <?php include 'partials/sidebar.html'; ?>
        </div>
        <!-- Sidebar Finish -->

        <!-- Navbar Start -->
        <?php include 'partials/header.html'; ?>
        <!-- Navbar Finish -->

        <!-- Main Content Start -->
        <div class="main-content" id="view-staff">
            <h1>View Staff</h1>
            <a href="#" class="add-btn" onclick="showSection('add-staff')">Add Staff</a>
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

        <div class="main-content" id="add-staff" style="display: none;">
            <h1>Add Staff Member</h1>
            <form method="POST" action="addstaff.php">
                <label for="staff-name">Name</label>
                <input type="text" id="staff-name" name="name">
                <label for="staff-email">Email</label>
                <input type="email" id="staff-email" name="email">
                <label for="staff-position">Position</label>
                <input type="text" id="staff-position" name="position">
                <label for="staff-department">Department</label>
                <input type="text" id="staff-department" name="department">
                <label for="staff-description">Description</label>
                <textarea id="staff-description" name="description" rows="4"></textarea>
                <input type="file" name="image" id="staff-image">
                <button type="submit">Add Staff</button>
            </form>
        </div>
        

        <div class="main-content" id="update-staff" style="display: none;">
            <h1>Update Staff</h1>
            <form>
                <label for="update-staff-select">Select Staff to Update</label>
                <select id="update-staff-select" name="id" required>
                    <!-- Options will be loaded dynamically -->
                </select>
                <label for="staff-name">Name</label>
                <input type="text" id="staff-name" name="name" required>
                <label for="staff-email">Email</label>
                <input type="email" id="staff-email" name="email" required>
                <label for="staff-position">Position</label>
                <input type="text" id="staff-position" name="position" required>
                <label for="staff-department">Department</label>
                <input type="text" id="staff-department" name="department" required>
                <label for="staff-description">Description</label>
                <textarea id="staff-description" name="description" rows="4" required></textarea>
                <button type="submit">Update Staff</button>
            </form>
        </div>

        <div class="main-content" id="delete-staff" style="display: none;">
            <h1>Delete Staff</h1>
            <form method="POST" action="deletestaff.php">
                <label for="delete-staff-select">Select Staff to Delete</label>
                <select id="delete-staff-select" name="id" required>
                    <!-- Options will be loaded dynamically -->
                </select>
                <button type="submit">Delete Staff</button>
            </form>
        </div>
    </div>
    <?php include 'partials/js.html'; ?>
</body>
</html>
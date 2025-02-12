<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Member Management</title>

    <?php include 'partials/style.html'; ?>

</head>
<body x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
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
        <div class="main-content" id="view">
            <h1 class="h1">View Members</h1>
            <a href="#" class="add-btn" onclick="setSection('add')">Add Member</a>
            <table>
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                        <td>123-456-7890</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>098-765-4321</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other members -->
                </tbody>
            </table>
        </div>

        <div class="main-content" id="add" style="display: none;">
            <h1 class="h1">Add Member</h1>
            <form>
                <label class="label" for="member-id">Member ID</label>
                <input type="number" class="member-form-input" id="member-id" name="member-id">
                <label class="label" for="member-name">Name</label>
                <input type="text" class="member-form-input" id="member-name" name="member-name">
                <label class="label" for="member-email">Email</label>
                <input type="email" class="member-form-input" id="member-email" name="member-email">
                <label class="label" for="member-phone">Phone Number</label>
                <input type="tel" class="member-form-input" id="member-phone" name="member-phone">
                <button class="member-form-button" type="submit">Add Member</button>
            </form>
        </div>

        <div class="main-content" id="update" style="display: none;">
            <h1 class="h1">Update Member</h1>
            <form action="updatemember.php" method="post">
                <label class="label" for="member-select">Select Member to Update</label>
                <select id="member-select" name="membername" required>
                    <option value="" disabled selected>Select member</option>
                    <option value="John Doe">John Doe</option>
                    <option value="Jane Smith">Jane Smith</option>
                    <option value="Alice Johnson">Alice Johnson</option>
                    <!-- Add more options as needed -->
                </select>
                <label class="label" for="member-email">Email</label>
                <input type="email" class="member-form-input" id="member-email" name="member-email" required>
                <label class="label" for="member-phone">Phone Number</label>
                <input type="tel" class="member-form-input" id="member-phone" name="member-phone" required>
                <label class="label" for="member-id">Member ID</label>
                <input type="text" class="member-form-input" id="member-id" name="member-id" required>
                <button class="member-form-button" type="submit">Update Member</button>
            </form>
        </div>

        <div class="main-content" id="delete" style="display: none;">
            <h1 class="h1">Delete Member</h1>
            <form action="deletemember.php" method="post">
                <label class="label" for="member-select">Select Member to Delete</label>
                <select id="member-select" name="membername">
                    <option value="" disabled selected>Select member</option>
                    <option value="John Doe">John Doe</option>
                    <option value="Jane Smith">Jane Smith</option>
                    <option value="Alice Johnson">Alice Johnson</option>
                    <!-- Add more options as needed -->
                </select>
                <button class="member-form-button" type="submit">Delete Member</button>
            </form>
        </div>
        <!-- Main Content End -->
    </div>
    
        <!-- Javascript -->
        <?php include 'partials/js.html'; ?>
        
</body>
</html>
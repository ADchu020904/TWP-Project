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
        <?php include 'partials/header.html'; ?>
        <!-- Navbar Finish -->

        <!-- Main Content Start -->
        <div class="main-content" id="view">
            <h1>View Members</h1>
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
                            <member-form-button class="edit-btn" onclick="setSection('update')">Edit</member-form-button>
                            <member-form-button class="delete-btn" onclick="setSection('delete')">Delete</member-form-button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>098-765-4321</td>
                        <td class="actions">
                            <member-form-button class="edit-btn" onclick="setSection('update')">Edit</member-form-button>
                            <member-form-button class="delete-btn" onclick="setSection('delete')">Delete</member-form-button>
                        </td>
                    </tr>
                    <!-- Repeat for other members -->
                </tbody>
            </table>
        </div>

        <div class="container" id="add" style="display: none;">
            <h1>Add Member</h1>
            <form>
                <label for="member-id">Member ID</label>
                <input type="number" id="member-id" name="member-id">
                <label for="member-name">Name</label>
                <input type="text" id="member-name" name="member-name">
                <label for="member-email">Email</label>
                <input type="email" id="member-email" name="member-email">
                <label for="member-phone">Phone Number</label>
                <input type="tel" id="member-phone" name="member-phone">
                <member-form-button type="submit">Add Member</member-form-button>
            </form>
        </div>

        <div class="container" id="update" style="display: none;">
            <h1>Update Member</h1>
            <form action="updatemember.php" method="post">
                <label for="member-select">Select Member to Update</label>
                <select id="member-select" name="membername" required>
                    <option value="" disabled selected>Select member</option>
                    <option value="John Doe">John Doe</option>
                    <option value="Jane Smith">Jane Smith</option>
                    <option value="Alice Johnson">Alice Johnson</option>
                    <!-- Add more options as needed -->
                </select>
                <label for="member-email">Email</label>
                <input type="email" id="member-email" name="member-email" required>
                <label for="member-phone">Phone Number</label>
                <input type="tel" id="member-phone" name="member-phone" required>
                <label for="member-id">Member ID</label>
                <input type="text" id="member-id" name="member-id" required>
                <member-form-button type="submit">Update Member</member-form-button>
            </form>
        </div>

        <div class="container" id="delete" style="display: none;">
            <h1>Delete Member</h1>
            <form action="deletemember.php" method="post">
                <label for="member-select">Select Member to Delete</label>
                <select id="member-select" name="membername">
                    <option value="" disabled selected>Select member</option>
                    <option value="John Doe">John Doe</option>
                    <option value="Jane Smith">Jane Smith</option>
                    <option value="Alice Johnson">Alice Johnson</option>
                    <!-- Add more options as needed -->
                </select>
                <member-form-button type="submit">Delete Member</member-form-button>
            </form>
        </div>
        <!-- Main Content End -->
    </div>
    
        <!-- Javascript -->
        <?php include 'partials/js.html'; ?>
        <script>
          function setSection(section) {
            ['view', 'add', 'update', 'delete'].forEach(function(id) {
              document.getElementById(id).style.display = 'none';
            });
            document.getElementById(section).style.display = 'block';
          }
        </script>
    
</body>
</html>
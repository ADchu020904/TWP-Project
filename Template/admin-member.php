<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Member Management</title>
      <!-- CoreUI CSS -->
      <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/css/coreui.min.css" rel="stylesheet">
        
      <!-- CoreUI Icons -->
      <link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/all.min.css">
              
      <!-- Custom CSS -->
      <link rel="stylesheet" href="css/satoshi.css" />
      <link rel="stylesheet" href="css/output.css" />
      
      <!-- Vector Map CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsvectormap/1.5.3/css/jsvectormap.min.css" />

      <!-- Alpine.js (for header interactivity) -->
      <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

      <!-- Tailwind CSS -->
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/js/coreui.bundle.min.js"></script>
    
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.container').forEach(container => {
                container.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</head>
<body class="bg-body-secondary">
    <div class="dashboard-container">
        <!-- Sidebar Start -->
        <?php include('partials/sidebar.html'); ?>
        <!-- Sidebar Finish -->

        <!-- Navbar Start -->
        <?php include('partials/header.html'); ?>
        <!-- Navbar Finish -->

        <!-- Main Content Start -->
        <div class="main-content">
            <h1>View Members</h1>
            <a href="#" class="add-btn" onclick="showSection('add')">Add Member</a>
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
                            <button class="edit-btn" onclick="showSection('update')">Edit</button>
                            <button class="delete-btn" onclick="showSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>098-765-4321</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="showSection('update')">Edit</button>
                            <button class="delete-btn" onclick="showSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other members -->
                </tbody>
            </table>
        
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
                    <button type="submit">Add Member</button>
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
                    <button type="submit">Update Member</button>
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
                    <button type="submit">Delete Member</button>
                </form>
            </div>
        </div>
        <!-- Main Content End -->
    </div>
    <!-- Include JS from admin-dashboard.php -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsvectormap/1.5.3/js/jsvectormap.min.js"></script>
    <script src="https://unpkg.com/jsvectormap@1.6.0/dist/maps/world.js"></script>
    <script src="js/index.js"></script>
    <script src="js/us-aea-en.js"></script>
</body>
</html>
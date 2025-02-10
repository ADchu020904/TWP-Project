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
<body x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
   <!-- Layout Container -->
   <div class="dashboard-container">
        <!-- Sidebar Start -->
        <?php include('partials/sidebar.html'); ?>
        <!-- Sidebar Finish -->

        <!-- Navbar Start -->
        <?php include('partials/header.html'); ?>
        <!-- Navbar Finish -->

        <!-- Main Content Start -->
        <div class="main-content" id="view">
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
                            <member-form-button class="edit-btn" onclick="showSection('update')">Edit</member-form-button>
                            <member-form-button class="delete-btn" onclick="showSection('delete')">Delete</member-form-button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>098-765-4321</td>
                        <td class="actions">
                            <member-form-button class="edit-btn" onclick="showSection('update')">Edit</member-form-button>
                            <member-form-button class="delete-btn" onclick="showSection('delete')">Delete</member-form-button>
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
    <!-- Include JS from admin-dashboard.php -->

     <!-- Add CoreUI Bundle JS -->
     <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/js/coreui.bundle.min.js"></script>
            
            <!-- Initialize CoreUI Components -->
            <script>
                // Initialize all CoreUI components
                document.addEventListener('DOMContentLoaded', function() {
                    coreui.Dropdown.init();
                });
            </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsvectormap/1.5.3/js/jsvectormap.min.js"></script>
    <script src="https://unpkg.com/jsvectormap@1.6.0/dist/maps/world.js"></script>
    <script src="js/index.js"></script>
    <script src="js/us-aea-en.js"></script>
</body>
</html>
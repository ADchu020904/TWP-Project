<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report Management</title>
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
                 <?php include 'partials/header.php'; ?>
                <!-- Navbar Finish -->
        <!-- Main Content Start -->
        <div class="main-content">
            <h1 class="text-center dark:text-white">Sales Report</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder for dynamic content -->
                </tbody>
            </table>
            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
            <div class="mt-4">
                <a href="admin-dashboard.php" class="btn btn-secondary">Return</a>
            </div>
        </div>
        <!-- Main Content End -->
    </div>
    <?php include 'partials/js.html'; ?>
</body>
</html>

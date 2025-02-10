<!doctype html>
<html lang="en">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Title -->
        <title>Admin Dashboard</title>

        <?php include('partials/style.html'); ?>
        
    </head>
    <body  x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
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
            <div class="main-content">
                <!-- Stat Cards -->
                <div class="stats-section">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="cil-chart" style="font-size: 1.5rem; color: #17a2b8;"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-value">$95k</p>
                            <p class="stat-label">Revenue</p>
                            <span class="stat-change positive">↑ 5.2%</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="cil-chart-pie" style="font-size: 1.5rem; color: #ffc107;"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-value">18.63%</p>
                            <p class="stat-label">Growth Rate</p>
                            <span class="stat-change negative">↓ 2.0%</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="cil-graph" style="font-size: 1.5rem; color: #28a745;"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-value">$27k</p>
                            <p class="stat-label">Sales</p>
                            <span class="stat-change positive">↑ 10.0%</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="cil-cart" style="font-size: 1.5rem; color: #fd7e14;"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-value">13,700</p>
                            <p class="stat-label">Orders</p>
                            <span class="stat-change negative">↓ 13.6%</span>
                        </div>
                    </div>
                </div>
    
                <!-- Visitor Overview Chart -->
                <div class="visitors-overview">
                    <h2>Visitors Overview</h2>
                    <canvas id="visitorsChart"></canvas>
                </div>
            </div>
            <!-- Main Content End -->

            <!-- Javascript -->
            <?php include('partials/js.html'); ?>
            
        </div>
    </body>
</html>
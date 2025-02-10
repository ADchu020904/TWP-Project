<!doctype html>
<html lang="en">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Title -->
        <title>Admin Dashboard</title>

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

            <!-- Chart.js Script -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
            <!-- Vector Map JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jsvectormap/1.5.3/js/jsvectormap.min.js"></script>
            <script src="https://unpkg.com/jsvectormap@1.6.0/dist/maps/world.js"></script>
            
            <!-- Add CoreUI Bundle JS -->
            <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/js/coreui.bundle.min.js"></script>
            
            <!-- Initialize CoreUI Components -->
            <script>
                // Initialize all CoreUI components
                document.addEventListener('DOMContentLoaded', function() {
                    coreui.Dropdown.init();
                });
            </script>

            <!-- Custom JavaScript -->
            <script>
                // Chart configuration
                const ctx = document.getElementById('visitorsChart').getContext('2d');
                const visitorsChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        datasets: [
                            {
                                label: 'Page Views',
                                data: [100, 200, 150, 300, 500, 400, 200],
                                backgroundColor: 'rgba(23, 162, 184, 0.2)',
                                borderColor: 'rgba(23, 162, 184, 1)',
                                fill: true,
                            },
                            {
                                label: 'Unique Visitors',
                                data: [50, 150, 100, 200, 400, 300, 100],
                                backgroundColor: 'rgba(220, 53, 69, 0.2)',
                                borderColor: 'rgba(220, 53, 69, 1)',
                                fill: true,
                            },
                            {
                                label: 'Total Visits',
                                data: [150, 250, 200, 350, 600, 500, 300],
                                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                                borderColor: 'rgba(40, 167, 69, 1)',
                                fill: true,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Months',
                                },
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Visitors',
                                },
                            },
                        },
                    },
                });
            </script>
            <script src="js/index.js"></script>
            <script src="js/us-aea-en.js"></script>
        </div>
    </body>
</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin/adminLogin.php");
    exit();
}

// Handle logout
if (isset($_POST['logout'])) {

    $_SESSION = array();
    
    session_destroy();
    
    header("Location: adminLogin.php");
    exit();
}

include 'admin_navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <style>
        .dashboard-container {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .chart-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .chart-card h3 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h1>Welcome to Admin Dashboard</h1>
        
        <div class="charts-grid">
            <!--  Booking Status Distribution -->
            <div class="chart-card">
                <h3>Booking Status Overview</h3>
                <div class="chart-container">
                    <canvas id="bookingStatusChart"></canvas>
                </div>
            </div>
            
            <!--  Revenue by Payment Status -->
            <div class="chart-card">
                <h3>Revenue by Payment Status</h3>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            
            <!--  Room Status -->
            <div class="chart-card">
                <h3>Room Status Distribution</h3>
                <div class="chart-container">
                    <canvas id="roomStatusChart"></canvas>
                </div>
            </div>
            
            <!--  Bookings by Room Type -->
            <div class="chart-card">
                <h3>Popular Room Types</h3>
                <div class="chart-container">
                    <canvas id="roomTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tfetchh data
        async function fetchChartData() {
            try {
                const response = await fetch('get_chart_data.php');
                const data = await response.json();
                
                // create all charts 
                createBookingStatusChart(data.bookingStatus);
                createRevenueChart(data.monthlyRevenue);
                createRoomStatusChart(data.roomStatus);
                createRoomTypeChart(data.roomTypes);
            } catch (error) {
                console.error('Error fetching chart data:', error);
            }
        }

        //  Booking Status Pie Chart
        function createBookingStatusChart(data) {
            const ctx = document.getElementById('bookingStatusChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Bookings',
                        data: data.values,
                        backgroundColor: [
                            '#4CAF50',  //  Confirmed
                            '#F44336',  //  Cancelled
                            '#2196F3'   //  Completed
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        //  Monthly Revenue Bar Chart
        function createRevenueChart(data) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Revenue ($)',
                        data: data.values,
                        backgroundColor: '#2196F3',
                        borderColor: '#1976D2',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            });
        }

        //  Room Status Doughnut Chart
        function createRoomStatusChart(data) {
            const ctx = document.getElementById('roomStatusChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Rooms',
                        data: data.values,
                        backgroundColor: [
                            '#4CAF50',  //  Available
                            '#FF9800',  //  Occupied
                            '#9E9E9E'   //  Maintenance
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        //  Room Type Bar Chart
        function createRoomTypeChart(data) {
            const ctx = document.getElementById('roomTypeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Number of Bookings',
                        data: data.values,
                        backgroundColor: '#9C27B0',
                        borderColor: '#7B1FA2',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y', 
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // load all charts when page loads
        window.addEventListener('load', function() {
            fetchChartData();
        });
    </script>
</body>
</html>
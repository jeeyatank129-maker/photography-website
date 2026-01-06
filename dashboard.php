<?php 
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit();
}

// Disable caching so that back button won’t show old content
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include('../config.php');

// Total Appointments
$appointmentQuery = "SELECT COUNT(*) AS total_appointments FROM appointment";
$appointmentResult = $conn->query($appointmentQuery);
$appointmentCount = $appointmentResult->fetch_assoc()['total_appointments'];

// Total Photos
$photoQuery = "SELECT COUNT(*) AS total_photos FROM photos";
$photoResult = $conn->query($photoQuery);
$photoCount = $photoResult->fetch_assoc()['total_photos'];

// Registered Users
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = $conn->query($userQuery);
$userCount = $userResult->fetch_assoc()['total_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeea's Studio | Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .main-content {
            margin-left: 240px; /* equal to sidebar width */
            padding: 20px;
        }

        /* --- Top Navbar --- */
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #092635;
            color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .top-navbar .navbar-brand {
            font-size: 20px;
            font-weight: bold;
        }

        .top-navbar .navbar-right a {
            color: #fff;
            text-decoration: none;
            background: #e74c3c;
            padding: 8px 14px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .top-navbar .navbar-right a:hover {
            background: #c0392b;
        }

        /* --- Dashboard Cards --- */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #2c3e50;
        }

        .card p {
            font-size: 26px;
            font-weight: bold;
            color: #1abc9c;
        }
    </style>
</head>
<body onload="disableBack();">
    <script>
    // Define the disableBack function
    function disableBack() {
      window.history.pushState(null, "", window.location.href);
      window.onpopstate = function () {
        window.history.pushState(null, "", window.location.href);
      };

      // Handle bfcache (important for Chrome/Firefox)
      window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
          window.location.reload();
        }
      });
    }
  </script>
    <?php include('sidebar.php'); ?>
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="navbar-brand">📊 Dashboard</div>
            <div class="navbar-right">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div> 

        <!-- Dashboard Content -->
        <div class="dashboard-cards">
            <a href="client_appointment.php" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h3>Total Appointments</h3>
                <p><?php echo $appointmentCount; ?></p>
            </div>
            </a>
            <a href="all_photo.php" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h3>Total Photos</h3>
                <p><?php echo $photoCount; ?></p>
            </div>
            </a>
            <a href="users.php" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h3>Registered Users</h3>
                <p><?php echo $userCount; ?></p>
            </div>
            </a>
        </div>
    </div>
</body>
</html>

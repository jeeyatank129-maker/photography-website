<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

// Fetch logged-in user if any
$user = null;
$appointments = null;
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // fetch appointments
        $stmt2 = $conn->prepare("SELECT * FROM appointment WHERE Email = ?");
        $stmt2->bind_param("s", $user['email']);
        $stmt2->execute();
        $appointments = $stmt2->get_result();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEEA's Studio</title>
    <style>
        /* Reset + Navbar CSS */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; }

        header { background-color: #092635; padding: 12px 30px; height: 70px;}
        .navbar { display: flex; align-items: center; }
        .site-logo { height: 50px; cursor: pointer; }

        .nav-menu { list-style: none; display: flex; gap: 30px; margin-left: 40px; margin-right: auto; }
        .nav-menu li a { text-decoration: none; color: #ffffff; font-size: 19px; font-family: Bauhaus Md BT; font-weight: 500; transition: color 0.3s ease; }
        .nav-menu li a:hover { color: #9EC8B9; }

        .nav-right { display: flex; align-items: center; gap: 10px; }
        .user-icon { height: 32px; width: 32px; border-radius: 50%; cursor: pointer; transition: transform 0.2s ease; }
        .user-icon:hover { transform: scale(1.1); }
        .username { color: #ffffff; font-size: 15px; font-weight: 500; }
        .logout-link { 
            font-size: 14px; 
            color: #9EC8B9; 
            text-decoration: none; 
            margin-left: 8px; 
            padding: 5px;
            border: 1px solid white;
            border-radius: 5px;
        }
        .logout-link:hover { color: #ffffff; }

        /* Modal (CSS only) */
        .modal {
            position: fixed;
            top: 0; left: 0; 
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal:target {
            display: flex;
        }
        .modal-content {
            background: #fff;
            width: 80%;
            max-width: 900px;
            border-radius: 10px;
            padding: 20px;
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        }
        .modal-content h2 { margin: 0 0 10px; color: #333; }
        .close-btn {
            position: absolute; top: 10px; right: 15px;
            font-size: 20px; text-decoration: none; color: #333;
        }
        .profile-info {
            background: #f9f9f9; padding: 15px;
            border-left: 4px solid #15484f;
            border-radius: 5px; margin-bottom: 20px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 14px; }
        th { background:#145252; color: #fff; }
       
       
        .no-data { color: #888; font-style: italic; }
    </style>
</head>
<body>
<header>
    <nav class="navbar">
        <!-- Left: Logo -->
        <div class="nav-left">
            <a href="admin/index.php"><img src="images/logo-icon/new_logo.png" alt="Studio Logo" class="site-logo"></a>
        </div>

        <!-- Middle: Menu -->
        <ul class="nav-menu">
            <li><a href="home.php">Home</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="<?php echo isset($_SESSION['user_id']) ? 'book.php' : 'login.php'; ?>">Book Appointment</a></li>
        </ul>

        <!-- Right: User/Profile -->
        <div class="nav-right">
            <a href="<?php echo isset($_SESSION['user_id']) ? '#profileModal' : 'login.php'; ?>">
                <img src="images/logo-icon/user(1).png" alt="User" class="user-icon">
            </a>
            <?php if (isset($_SESSION['fullname'])): ?>
                <span class="username"><?php echo htmlspecialchars($_SESSION['fullname']); ?></span>
                <a href="logout.php" class="logout-link">Logout</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- Modal Box -->
<div class="modal" id="profileModal">
    <div class="modal-content">
        <a href="#" class="close-btn">&times;</a>
        <?php if ($user): ?>
            <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?></h2>
            <div class="profile-info">
                <p><b>Full Name - </b> <?php echo htmlspecialchars($user['fullname']); ?></p>
                <p><b>Email - </b> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <h3>Your Appointments</h3>
            <?php if ($appointments && $appointments->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>First</th><th>Last</th><th>Phone</th>
                            <th>Purpose</th><th>Message</th><th>Book Date</th><th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $appointments->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['First_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Phone_No']); ?></td>
                            <td><?php echo htmlspecialchars($row['Purpose']); ?></td>
                            <td><?php echo htmlspecialchars($row['Message']); ?></td>
                            <td><?php echo htmlspecialchars($row['book_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">No appointments found.</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="no-data">Please <a href="login.php">login</a> to see your profile.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>

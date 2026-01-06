<?php
include('../config.php');

$categories = [];
$sql = "SELECT cat_id, cat_name FROM categories ORDER BY cat_name";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeea's Studio</title>
    
    <style>
        /* --- Sidebar Base --- */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background: #092635;
            color: #fff;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 8px rgba(0,0,0,0.2);

             overflow-y: auto;   /* ✅ enable vertical scrolling */
    overflow-x: hidden;
        }

        .site-logo {
            height: 70px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        .sidebar-header {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 20px 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: #051b24;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu li a {
            display: block;
            padding: 12px 20px;
            color: #e0e0e0;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li.active a {
            background: #004d40;
            color: #fff;
            padding-left: 25px;
        }

        .menu-category {
            padding: 12px 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #8aa7a5;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* Dropdown Menu */
        .dropdown {
            list-style: none;
            margin: 0;
            padding: 0 0 0 20px;
            display: none;
        }

        .dropdown.show {
            display: block;
        }

        .dropdown li a {
            padding: 10px 20px;
            font-size: 14px;
            color: #cddcdc;
        }

        .dropdown li a:hover {
            color: #fff;
            background: #02675c;
        }

        .no-category {
            padding: 10px 20px;
            font-size: 13px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../images/logo-icon/new_logo.png" alt="Studio Logo" class="site-logo">
        </div>

        <ul class="sidebar-menu">
            <li class="menu-category">Main Category</li>
            <li>
                <a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>   Dashboard
                </a>
            </li>
            <br>
            <li class="menu-category">Clients Appointment</li>
            <li>
                <a class="toggle-dropdown">
                    <i class="fas fa-calendar-check"></i> Appointments
                </a>
                <ul class="dropdown">
                    <li><a href="client_appointment.php">All</a></li>
                    <li><a href="approved.php">Approved</a></li>
                    <li><a href="pending.php">Pending</a></li>
                </ul>
            </li>
            <br>
            <li class="menu-category">Gallery Managements</li>
            <li>
                <a class="toggle-dropdown"><i class="fas fa-tags"></i> Categories</a>
                <ul class="dropdown">
                    <li><a href="categories.php">Upload Photos</a></li>
                     <li><a href="all_photo.php">All Photos</a></li>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="gallery.php?cat_id=<?php echo $category['cat_id']; ?>">
                                    <?php echo htmlspecialchars($category['cat_name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><span class="no-category">No categories found.</span></li>
                    <?php endif; ?>
                    </ul>
            </li>   <br>
                    <li class="menu-category">User Management</li>
                    <li>
                        <a class="toggle-dropdown"><i class="fas fa-users"></i> Users</a>
                        <ul class="dropdown">
                            <li><a href="users.php">All Users</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <script>
        // Toggle dropdowns on click
        document.querySelectorAll('.toggle-dropdown').forEach(item => {
            item.addEventListener('click', function() {
                let dropdown = this.nextElementSibling;
                dropdown.classList.toggle('show');
            });
        });
    </script>
</body>
</html>

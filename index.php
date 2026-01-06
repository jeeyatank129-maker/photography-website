
<?php
session_start();
include('../config.php'); 

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $valid_username = 'jeea_studio';
    $valid_password = 'studio2012'; 

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        echo $_SESSION['admin_username'];
        header('Location: dashboard.php'); 
        exit();
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - JEEA'S STUDIO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!-- use same css as user -->
<style>
     .site-logo {
            height: 70px;
            width: auto;
            display: block;
            margin: 0 auto;
            background-color: #092635;
        }

        </style>
</head>

<body>
    <div class="container">
        
        <h2>Admin Login</h2>
        <img src="../images/logo-icon/new_logo.png" alt="Studio Logo" class="site-logo"><br><br>
        <?php if ($error_message): ?>
            <div class="message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

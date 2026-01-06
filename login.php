<?php
session_start();

require_once 'config.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL to fetch user
    $sql = "SELECT id, fullname, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: book.php"); // Redirect to book.php after successful login
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Invalid email or password.";
    }
    $stmt->close();
}
?>

<?php require('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - JEEA'S STUDIO</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email ID" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p class="p2">Don't have an account? <a href="registration.php"> Register here</a></p>
    </div>
</body>
</html>
<?php require('footer.php'); ?>

<?php
session_start();
require_once 'config.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Add server-side validation for proper email format and domain
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Error: Please enter a valid email address.";
    } 
    // Check if the valid email address ends with @gmail.com
    else if (!str_ends_with($email, "@gmail.com")) {
        $message = "Error: Only Gmail addresses are allowed for registration.";
    }
    // Validate password length
    else if (strlen($password) < 6) {
        $message = "Error: Password must be at least 6 characters long.";
    } else {
        // Check if the email already exists
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();
        
        if ($check_stmt->num_rows > 0) {
            $message = "Error: This email is already registered. Please login or use a different email.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $fullname, $email, $hashed_password);

            if ($stmt->execute()) {
                header("Location: login.php?success=1");
                exit();
            } else {
                $message = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<?php require('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - JEEA'S STUDIO</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="registration.php" method="post">
            <input type="text" name="fullname" oninput="this.value=this.value.toUpperCase()" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email ID" required>
            <input type="password" name="password" placeholder="Password (min. 6 characters)" required minlength="6">
            <button type="submit">Register</button>
        </form>

        <p class="p2">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
<?php require('footer.php'); ?>

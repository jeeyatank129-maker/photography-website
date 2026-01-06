<?php 
session_start(); 

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Disable caching so that back button won’t show old content
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require('header.php'); 
include('config.php');

$message_status = ''; // Variable for messages from this page's form submission
$message_type = '';

if (isset($_POST["send"])) {
    $fnm = $_POST['fname'];
    $lnm = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $prp = $_POST['purpose'];
    $message = $_POST['message'];

    $query = "INSERT INTO appointment(First_name, Last_name, Email, Phone_No, Purpose, Message)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $fnm, $lnm, $email, $phone, $prp, $message);
    
    if (mysqli_stmt_execute($stmt)) {
        $message_status = "Your appointment has been booked successfully! Awaiting approval.";
        $message_type = "success";
    } else {
        $message_status = "Failed to book appointment. Please try again.";
        $message_type = "error";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #092635;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #092635;
        }

        /* Form grid layout */
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 1 1 calc(50% - 20px);
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            flex: 1 1 100%;
        }

        label {
            margin-bottom: 6px;
            font-weight: bold;
            color: #092635;
        }

        input, textarea {
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background: #9EC8B9;
            color: #092635;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            text-align: center;
            width: 100%;
        }

        input[type="submit"] {
            background: #092635;
            color: #fff;
            padding: 14px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #78A083;
            color: #092635;
        }
        /* Fade-in + fade-out */
@keyframes fadeInOut {
    0% { opacity: 0; transform: translateY(-10px); }
    10% { opacity: 1; transform: translateY(0); }
    90% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-10px); }
}

.message-box {
    max-width: 900px;
    margin: 20px auto;
    background-color:#78A083;
    padding: 15px 20px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;
    text-align: center;
    animation: fadeInOut 5s ease-in-out forwards; /* runs once and fades out */
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

    <div class="container">
        <h1>Book Your Appointment</h1>
        <form method="POST">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" oninput="this.value=this.value.toUpperCase()" placeholder="First Name" required>
            </div>
            
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" oninput="this.value=this.value.toUpperCase()" placeholder="Last Name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" 
                id="phone" 
                name="phone" 
                pattern="[0-9]{10}" 
                title="Please enter a 10-digit phone number (e.g.,1234567890)" 
                maxlength="10" placeholder="Phone Number" required>
            </div>
            
            <div class="form-group">
                <label for="purpose">Purpose</label>
                <input type="text" id="purpose" name="purpose" placeholder="Purpose of Appointment">
            </div>
            
            <div class="form-group full">
                <label for="message">Additional Information</label>
                <textarea id="message" name="message" placeholder="Write here (max 2200 chars)"></textarea>
            </div>
            
            <div class="form-group full submit-btn">
                <input type="submit" value="Send" name="send">
            </div>
        </form>
    </div>
    <?php
        // Check for session messages from the admin side
        if (isset($_SESSION['message'])) {
            $session_message = $_SESSION['message'];
            $status_type = isset($_SESSION['status_type']) ? $_SESSION['status_type'] : '';
            echo "<div class='message-box " . htmlspecialchars($status_type) . "'>" . htmlspecialchars($session_message) . "</div>";
            unset($_SESSION['message']);
            unset($_SESSION['status_type']);
        }
        
        // Display a message after this form's submission
        if (!empty($message_status)) {
            echo "<div class='message-box " . htmlspecialchars($message_type) . "'>" . htmlspecialchars($message_status) . "</div>";
        }
        ?>
</body>
<script>
    // Auto-hide message box after 5 seconds
    setTimeout(function() {
        let box = document.querySelector('.message-box');
        if (box) {
            box.style.display = 'none';
        }
    }, 5000); // 5 seconds
</script>

</html>

<?php require('footer.php'); ?>
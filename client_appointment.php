<?php
ob_start();
session_start();
require('../config.php'); 
require('sidebar.php');
require('function.php');

// Handle POST actions using the PRG pattern
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    handleAppointmentAction($conn, $_POST['appointment_ID'], $_POST['action']);
    // Redirect to the same page to prevent form resubmission and refresh data
    header("Location: " . $_SERVER['PHP_SELF']);
    exit(); // Always call exit after a header redirect
}

// Fetch all appointments
$result = fetchAppointments($conn);
$totalRecords = countAppointments($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/appointments_ap.css">
    <style>
        .message-box {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .warning {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
        }
        .danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <?php
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $status_type = isset($_SESSION['status_type']) ? $_SESSION['status_type'] : '';
            echo "<div class='message-box " . htmlspecialchars($status_type) . "'>" . htmlspecialchars($message) . "</div>";
            unset($_SESSION['message']);
            unset($_SESSION['status_type']);
        }
        ?>
        <h1>Client Appointments</h1>
        <p class="total">Total Appointments: <?php echo $totalRecords; ?></p>
        <table>
            <?php if ($result->num_rows > 0): ?>
                <thead>
                    <tr>
                        <th>First Name</th><th>Last Name</th><th>Email</th>
                        <th>Phone Number</th><th>Purpose</th><th>Message</th>
                        <th>Book Date</th>
                        <th>Status</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['First_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                            <td><?php echo htmlspecialchars($row['Phone_No']); ?></td>
                            <td><?php echo htmlspecialchars($row['Purpose']); ?></td>
                            <td><?php echo htmlspecialchars($row['Message']); ?></td>
                            <td><?php echo htmlspecialchars($row['book_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td> 
                                <form method="POST" style="display:inline;">
                                   <input type="hidden" name="appointment_ID" value="<?php echo $row['appointment_ID']; ?>">
                                   <button type="submit" name="action" value="approve">Approve</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_ID" value="<?php echo $row['appointment_ID']; ?>">
                                    <button type="submit" name="action" value="pending">Pending</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_ID" value="<?php echo $row['appointment_ID']; ?>">
                                    <button type="submit" name="action" value="canceled">Canceled</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_ID" value="<?php echo $row['appointment_ID']; ?>">
                                    <button type="submit" name="action" value="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center; padding:20px;">No appointments found.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </body>
        </html>
<?php
$conn->close();       
ob_end_flush();       
?>
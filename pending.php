<?php
require('../config.php');
require('sidebar.php');
require('function.php');

// Handle POST actions (approve/delete)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    handleAppointmentAction($conn, $_POST['appointment_ID'], $_POST['action']);
}

// Fetch only pending appointments
$result = fetchAppointments($conn, 'pending');
$totalRecords = countAppointments($conn, 'pending');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Appointments</title>
    <link rel="stylesheet" href="css/appointments_ap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
    <div class="main-content">
        <h1><i class="fas fa-clock"></i> Pending Appointments</h1>
        <p class="total">Total Appointments: <?php echo $totalRecords; ?></p>

        <table>
            <?php if ($result->num_rows > 0): ?>
                <thead>
                    <tr>
                        <th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th>
                        <th>Purpose</th><th>Message</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['First_name']); ?></td>
                            <td><?= htmlspecialchars($row['Last_name']); ?></td>
                            <td><?= htmlspecialchars($row['Email']); ?></td>
                            <td><?= htmlspecialchars($row['Phone_No']); ?></td>
                            <td><?= htmlspecialchars($row['Purpose']); ?></td>
                            <td><?= htmlspecialchars($row['Message']); ?></td>
                            <td>
                                <!-- Move back to Approve -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_ID" value="<?= $row['appointment_ID'] ?>">
                                    <button type="submit" name="action" value="approve">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <!-- Delete -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_ID" value="<?= $row['appointment_ID'] ?>">
                                    <button type="submit" name="action" value="delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
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
<?php $conn->close(); ?>
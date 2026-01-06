<?php 
require('../config.php'); 
require('sidebar.php'); 

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action == 'delete') {
        $sql = "DELETE FROM users WHERE id='$user_id'";
        $conn->query($sql);
    } 
    
}

// Fetch users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$totalRecords = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="css/appointments_ap.css"> <!-- reuse your CSS -->
</head>
<body>
  <div class="main-content">
    <h1><i class="fas fa-address-book"></i>  Registered Users</h1>
    <p class="total">Total Users: <?php echo $totalRecords; ?></p>
    <table>
      <?php if ($result->num_rows > 0): ?>
      <thead>
        <tr>
          
          <th>Full Name</th>
          <th>Email</th>
          <th>Registration Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          
          <td><?php echo htmlspecialchars($row['fullname']); ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td><?php echo htmlspecialchars($row['registration_date']); ?></td>
          <td>
            <!-- Delete user -->
            <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?');">
              <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
              <button type="submit" name="action" value="delete">Delete</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
      <?php else: ?>
        <tr>
          <td colspan="5" style="text-align:center; padding:20px;">No users found.</td>
        </tr>
      <?php endif; ?>
    </table>
  </div>
</body>
</html>
<?php $conn->close(); ?>

<?php
session_start();
include('sidebar.php');
include('../config.php');
 // Start session for toast messages

// Fetch categories for the dropdown menu
$categories = [];
$sql = "SELECT cat_id, cat_name FROM categories ORDER BY cat_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Upload Photos</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
/* Existing CSS */
.main-content { margin-left: 260px; padding: 20px; }
.container { max-width: 300px; height: 350px; margin: 150px auto; 
    padding: 30px; background-color: white; border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
h2 { color: #2c3e50; text-align: center; margin-bottom: 20px; }
form { display: flex; flex-direction: column; gap: 20px; }
form > div { display: flex; flex-direction: column; }
label { font-weight: bold; margin-bottom: 8px; color: #555; }
select, input[type="file"] { width: 100%; padding: 12px; border: 1px solid #ccc; 
    border-radius: 8px; box-sizing: border-box; font-size: 16px; background-color: #fafafa; 
    transition: border-color 0.3s; }
select:focus, input[type="file"]:focus { outline: none; border-color: #1abc9c; }
button[type="submit"] { background-color: #1abc9c; color: white; border: none; 
    padding: 15px 20px; font-size: 18px; font-weight: bold; border-radius: 8px; 
    cursor: pointer; transition: background-color 0.3s, transform 0.2s; margin-top: 20px; }
button[type="submit"]:hover { background-color: #16a085; transform: translateY(-2px); }
.gallery-item a { text-decoration: none; color: #007bff; font-weight: normal; font-size: 1.2em; }

/* Toast Notification CSS */
#toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #78A083;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 9999;
}
#toast.error { background-color: #E74C3C; }
#toast.info { background-color: #3498DB; }
#toast button {
    background: rgba(255,255,255,0.3);
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
}
</style>
</head>
<body>

<?php
if (isset($_SESSION['message'])):
    $msg = $_SESSION['message'];
    $status = $_SESSION['status_type'] ?? 'info';
    unset($_SESSION['message'], $_SESSION['status_type']);
?>
<div id="toast" class="<?php echo $status; ?>">
    <?php echo htmlspecialchars($msg); ?> 
    <button id="closeToast">OK</button>
</div>
<?php endif; ?>


<div class="container">
    <h2>Upload New Photo</h2>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <div>
            <label for="cat_id">Select Category:</label>
            <select name="cat_id" id="cat_id" required>
                <option value="" disabled selected>-- Select a category --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['cat_id']); ?>">
                        <?php echo htmlspecialchars($category['cat_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="image">Choose Image:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <button type="submit">Upload</button>
    </form>
</div>

<!-- JS for Toast -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toast = document.getElementById('toast');
    if(toast) {
        const btn = document.getElementById('closeToast');
        btn.addEventListener('click', function() {
            toast.style.display = 'none';
        });

        // Auto-hide after 3 seconds
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }
});
</script>
</body>
</html>
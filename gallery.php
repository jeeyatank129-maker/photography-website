<?php
include('../config.php');

// Get category ID from URL
$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;

// If category ID is provided
if ($cat_id) {
    // Fetch category name
    $cat_sql = "SELECT cat_name FROM categories WHERE cat_id = '$cat_id'";
    $cat_result = mysqli_query($conn, $cat_sql);
    $cat_row = mysqli_fetch_assoc($cat_result);
    $cat_name = $cat_row['cat_name'];

    // Fetch images from selected category
    $sql = "SELECT image_name, image_path FROM photos WHERE cat_id = '$cat_id'";
    $result = mysqli_query($conn, $sql);
} else {
    echo "No category selected.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title><?php echo $cat_name; ?> - Gallery </title>
   
</head>
<body>
    <a href="categories.php" style="color: black; padding: 6px; border: 1px solid black; border-radius: 2px; background-color: grey; float: right; width: 12px; height: 15px;"><i class="fa fa-close"></i></a>
    <h2>  <?php echo $cat_name; ?> Photography </h2>
    <div class="gallery">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="gallery-item">
                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['image_name']; ?>">
                    <p><?php echo $row['image_name']; ?></p>
                    
                    <form method="POST" action="delete.php">
                        <input type="hidden" name="image_name" value="<?php echo $row['image_name']; ?>">
                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                        <button type="submit" style="margin-top: 8px;background-color: red;color: white;border: none;padding: 8px">Delete</button>
                    </form>
                </div>
            <?php } ?>
        <?php else: ?>
            <p>No photos uploaded.</p>
        <?php endif; ?>
    </div>
</body>
</html>
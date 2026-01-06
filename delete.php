<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_name'], $_POST['cat_id'])) {
    $image_name = $_POST['image_name'];
    $cat_id = $_POST['cat_id'];

    // Get image path from DB
    $query = "SELECT image_path FROM photos WHERE image_name = '$image_name' AND cat_id = '$cat_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $image_path = $row['image_path'];

        // Delete image file from server
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete record from DB
        $delete_sql = "DELETE FROM photos WHERE image_name = '$image_name' AND cat_id = '$cat_id'";
        mysqli_query($conn, $delete_sql);
    }

    // Redirect back to the same category gallery
    header("Location: gallery.php?cat_id=$cat_id");
    exit();
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $cat_id = $_POST['cat_id'];
    $target_dir = "../uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES['image']['name']);
    $image_name = basename($_FILES['image']['name']);
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION['message'] = "Sorry, file already exists.";
        $_SESSION['status_type'] = "error";
        $uploadOk = 0;
    }

    // File size limit: 500MB
    if ($_FILES['image']['size'] > 500000000) {
        $_SESSION['message'] = "Sorry, your file is too large.";
        $_SESSION['status_type'] = "error";
        $uploadOk = 0;
    }

    // Allowed file formats
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG files are allowed.";
        $_SESSION['status_type'] = "error";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $_SESSION['message'] = $_SESSION['message'] ?? "Sorry, your file was not uploaded.";
        $_SESSION['status_type'] = $_SESSION['status_type'] ?? "error";
        header("Location: categories.php");
        exit();
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO photos (cat_id, image_name, image_path) VALUES ('$cat_id', '$image_name', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "The file '$image_name' has been uploaded successfully.";
                $_SESSION['status_type'] = "success";
            } else {
                $_SESSION['message'] = "Database error: " . mysqli_error($conn);
                $_SESSION['status_type'] = "error";
            }
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            $_SESSION['status_type'] = "error";
        }
        header("Location: categories.php");
        exit();
    }
}

mysqli_close($conn);
?>
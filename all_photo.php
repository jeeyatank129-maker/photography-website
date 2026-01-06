<?php 
include('../config.php');

// Get category ID from URL (if any)
$cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : null;

    $sql = "SELECT p.image_name, p.image_path, c.cat_name 
            FROM photos p
            JOIN categories c ON p.cat_id = c.cat_id
            ORDER BY p.upload_date DESC";
    $page_title = "All Photos";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> - Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
          .category-label {
            font-size: 12px;
            color: #555;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <a href="categories.php" 
       style="color: black; padding: 6px; border: 1px solid black; border-radius: 2px; background-color: grey; float: right;">
       <i class="fa fa-close"></i>
    </a>

    <h2><?php echo $page_title; ?></h2>

    <div class="gallery">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="gallery-item">
                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['image_name']; ?>">
                   
                    <p class="category-label"> <?php echo $row['cat_name']; ?></p>

                    <form method="POST" action="delete.php">
                        <input type="hidden" name="image_name" value="<?php echo $row['image_name']; ?>">
                        <?php if ($cat_id): ?>
                            <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                        <?php endif; ?>
                       
                    </form>
                </div>
            <?php } ?>
        <?php else: ?>
            <p>No photos uploaded.</p>
        <?php endif; ?>
    </div>
</body>
</html>

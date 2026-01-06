<?php 
require('header.php');
include('config.php');

// Fetch categories
$categories = [];
$cat_sql = "SELECT cat_id, cat_name FROM categories ORDER BY cat_name";
$cat_result = mysqli_query($conn, $cat_sql);
if (mysqli_num_rows($cat_result) > 0) {
    while ($row = mysqli_fetch_assoc($cat_result)) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/style.css">     
    <title>JEEA'S STUDIO - Gallery</title>
    <style>
        /* --- Image Styling --- */
        .img {
            border: 5px solid #fff;
            border-radius: 5px;
            max-width: 100%;
            height: auto;
            object-fit: cover;
            cursor: pointer;
            filter: grayscale(100%);
            transition: filter 0.3s, transform 0.3s;
        }
        .img:hover {
            filter: none;
            transform: scale(1.05);
        }

        /* --- Category Buttons --- */
        .category-buttons {
            text-align: center;
            margin: 40px 0 20px 0;
            flex-wrap: wrap;
            border-top: 1px solid #444;            
        }
        .category-buttons button {
            background-color: #9EC8B9;
            color: #092635;
            border: none;
            padding: 15px 25px;
            margin: 8px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            transition: background-color 0.3s, color 0.3s;
        }
        .category-buttons button:hover,
        .category-buttons button.active {
            background-color: #092635;
            color: #78A083;
        }

        /* --- Gallery Layout --- */
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }
        .category-section {
            display: none;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
            gap: 20px;
        }
        .category-section img {
            width:  450px;
            height: 350px;
            object-fit: cover; /* keeps proportion without stretching */
        }

        /* --- Lightbox Modal --- */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(10px);
            justify-content: center;
            align-items: center;
        }
        .lightbox img {
            max-width: 100%;
            max-height: 95%;
        }
        .lightbox:target {
            display: flex;
        } 
        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 40px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .category-section img {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>

<div class="category-buttons">
    <?php foreach ($categories as $cat):
        $cat_id = $cat['cat_id'];
        $cat_name = strtolower($cat['cat_name']);
    ?>
        <button onclick="filterGallery('<?php echo $cat_name; ?>', event)">
            <?php echo htmlspecialchars($cat['cat_name']); ?>
        </button>
    <?php endforeach; ?>
</div>

<div class="gallery-container">
    <?php foreach ($categories as $cat):
        $cat_id = $cat['cat_id'];
        $cat_name = strtolower($cat['cat_name']);
        $img_sql = "SELECT image_name FROM photos WHERE cat_id = '$cat_id'";
        $img_result = mysqli_query($conn, $img_sql);
    ?>
        <div class="category-section" id="<?php echo $cat_name; ?>">
            <?php while ($img = mysqli_fetch_assoc($img_result)) { ?>
                <img src="uploads/<?php echo $img['image_name']; ?>" 
                     alt="<?php echo $img['image_name']; ?>" 
                     class="img" 
                     onclick="openLightbox(this.src)">
            <?php } ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <a href="javascript:void(0)" class="lightbox-close" onclick="closeLightbox()">&times;</a>
    <img id="lightbox-img" src="" alt="Preview">
</div>

<script>
    function filterGallery(category, event) {
        const sections = document.querySelectorAll('.category-section');
        sections.forEach(section => section.style.display = 'none');

        const buttons = document.querySelectorAll('.category-buttons button');
        buttons.forEach(button => button.classList.remove('active'));

        const section = document.getElementById(category);
        if (section) section.style.display = 'flex';

        event.currentTarget.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.category-buttons button');
        if (buttons.length > 0) {
            buttons[0].click(); // Show first category by default
        }
    });

    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox').style.display = 'flex';
    }
    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }
</script>

</body>
</html>

<?php require('footer.php'); ?>

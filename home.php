<?php 
    require('header.php'); 
    require('config.php');

$categories = [];
$sql = "SELECT cat_id, cat_name FROM categories ORDER BY cat_name";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>
<html>
<head>
 <meta charset="UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

 <link rel="stylesheet" type="text/css" href="css/style.css">
 <title>JEEA'S STUDIO - About Us</title>
 <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .overlay {
        background: url("images/pre-wedd/pre-wed (10).JPG") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        padding: 50px 20px;
    }

    .container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px;
        background: rgba(221, 208, 208, 0.19); /* transparent white */
        border-radius: 5px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        backdrop-filter: blur(12px); /* blur effect behind the box */
    }

    h1 {
        text-align: center;
        color: #fff;
        font-family: Bauhaus Md BT;
        margin-bottom: 40px;
        font-size: 38px;
        letter-spacing: 2px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
    }

    .about-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .about-section {
        background: rgba(19, 15, 15, 0.18);
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .about-section h2 {
        color: #fff;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .about-section p, 
    .about-section ul {
        color: #f1f1f1;
        font-size: 14px;
        line-height: 1.6;
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: opacity 0.5s ease, max-height 0.5s ease;
    }

    .about-section ul {
        list-style: none;
        padding: 0;
        
    }

    .about-section ul li a{
        margin: 6px 0;
            text-decoration: none;
            color:white;
    }
    .about-section ul li a:hover{
    color:black;
    }

    /* Hover Effect */
    .about-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        background: rgba(255, 255, 255, 0.35);
    }

    .about-section:hover p,
    .about-section:hover ul {
        opacity: 1;
        max-height: 500px;
        color: black;    
    }
    .service-section{
        padding-top:35px;
       text-align: center;
       color: white;
    }
    .service-section a
    {   border:1px solid  #092635;
        border-radius: 5px;
        padding: 5px;
        background-color: #092635;
        text-decoration:none; 
        color:white;
    }
    .service-section a:hover {
        color:#9EC8B9;
    }
    
 </style>
</head>
<body>

<div class="overlay">
    <div class="container">
        <h1>JEEA STUDIO</h1>

        <div class="about-wrapper">
            <div class="about-section">
                <h2>About Us</h2>
                <p>
                    At <b>JEEA STUDIO</b>, we believe every picture tells a story.  
                    Our passion is capturing life’s most cherished moments — weddings, portraits, or a child’s first smile.  
                    With creativity and professionalism, we turn your moments into timeless memories.
                </p>
            </div>

            
            <div class="about-section">
                <h2>Meet the Photographer</h2>
                <p>
                    Hi, I’m <b>Jeea</b>, the founder and lead photographer at JEEA STUDIO.  
                    With years of experience and a passion for storytelling, I capture emotions, beauty, and authenticity in every frame.  
                </p>
            </div>

            <div class="about-section">
                <h2>Why Choose Us?</h2>
                <ul>
                    <li>Professional & Creative Photography</li>
                    <li>Friendly, Comfortable Sessions</li>
                    <li>Customized Packages</li>
                    <li>High-Quality Edited Images</li>
                    <li>Memories that Last a Lifetime</li>
                </ul>
            </div>

            

        </div>

        <div class="service-section">
                     
                     <a href="gallery.php"> <i class="fa-solid fa-wand-magic-sparkles"></i> Explore Our Gallery</a>
            </div>
        
    </div>
</div>
</body>
</html>

<?php
    require('footer.php');
?>

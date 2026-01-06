<?php  
    require('header.php'); 
?>
<html>
<head>
 <meta charset="UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <link rel="stylesheet" type="text/css" href="css/style.css">
 <title>JEEA'S STUDIO</title>
 <style>
    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 25px;
        color: #092635;
        font-family: "Times New Roman", serif;
    }

    /* Horizontal layout */
    .contact-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: stretch; /* ensures both map & info align in height */
    }

    .map {
        flex: 1 1 55%;
        min-width: 300px;
        border: 0;
        border-radius: 8px;
        height: 400px;
    }

    .contact-info {
        flex: 1 1 40%;
        min-width: 280px;
        color: #092635;
        background-color: lightgray;
        padding: 20px;
        border-radius: 5px;
        font-family: "Roboto Slab", serif;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-info h3 {
        margin: 15px 0 5px;
        font-size: 18px;
        border-bottom: 1px solid #092635;
        display: inline-block;
    }

    .social-links {
        margin-bottom: 20px;
        text-align: center;
    }

    .social-links a {
        margin: 0 10px;
        display: inline-block;
    }

    .social-links img {
        width: 40px;
        transition: transform 0.2s;
    }

    .social-links img:hover {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .contact-wrapper {
            flex-direction: column;
        }
        .map, .contact-info {
            width: 100%;
        }
    }
 </style>
</head>
<body>
<div class="container">
    <h1>Contact Us</h1>
    <div class="contact-wrapper">
        <!-- Left side: Map -->
        <iframe class="map" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.438738607849!2d70.8045022757447!3d22.261364344304766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca7ee643875b%3A0x7fc41cc108da05d0!2sStudio%20JEEA&#39;s!5e0!3m2!1sen!2sin!4v1721555890510!5m2!1sen!2sin" 
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    
        <!-- Right side: Contact details -->
        <div class="contact-info">
            <div class="social-links">
                <a href="https://www.facebook.com/profile.php?id=100070123291556"><img src="images/logo-icon/fb.png"></a>
                <a href="https://www.instagram.com/jeea_studio/" target="_blank"><img src="images/logo-icon/insta.png"></a>
                <a href="https://www.youtube.com/@happinesslife2070" target="_blank"><img src="images/logo-icon/youtube.png"></a>
            </div>

            <h3>Email</h3>
            <p><b>jeeastudio2012@gmail.com</b></p>

            <h3>Phone No</h3>
            <p><b>+91 942644135</b></p>

            <h3>Address</h3>
            <p><b>
                JEEA STUDIO, <br>
                Nehrunagar 80ft Main Road,<br>
                Opp. Milan Hall, <br>
                Rajkot (Gujarat)
            </b></p>
        </div>
    </div>
</div>
</body>
</html>

<?php
    require('footer.php');
?>

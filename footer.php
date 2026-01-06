<!-- footer.php -->
<style>
/* --- Footer Styles --- */
footer {
    background-color: #092635;
    color: #ffffff;
    padding: 40px 30px 20px;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 40px;
    margin-bottom: 20px;
}

.footer-section h3, 
.footer-section h4 {
    margin-bottom: 12px;
    color: #9EC8B9; /* soft highlight color */
    font-size: 18px;
}

.footer-section p {
    font-size: 14px;
    color: #ddd;
    line-height: 1.6;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin: 6px 0;
}

.footer-section ul li a {
    color: #ccc;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #9EC8B9;
}

.social-icons a {
    display: inline-block;
    margin-right: 12px;
}

.social-icons img {
    width: 26px;
    height: 26px;
}

.social-icons img:hover {
    transform: scale(1.2);
}

.footer-bottom {
    border-top: 1px solid #444;
    padding-top: 15px;
    text-align: center;
    font-size: 13px;
    color: #bbb;
}

.footer-bottom a {
    color: #9EC8B9;
    margin-left: 8px;
    text-decoration: none;
    font-size: 13px;
}

.footer-bottom a:hover {
    color: #ffffff;
}
</style>

<footer>
  <div class="footer-container">
    <!-- Studio Info -->
    <div class="footer-section">
      <h3>JEEA's Studio</h3>
      <p>Capturing your moments with creativity and professionalism. 
         Photography that tells your story.</p>
    </div>

    <!-- Quick Links -->
    <div class="footer-section">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="<?php echo isset($_SESSION['user_id']) ? 'book.php' : 'login.php'; ?>">Book Appointment</a></li>
      </ul>
    </div>

    <!-- Contact Info -->
    <div class="footer-section">
      <h4>Contact</h4>
      <p> Email: jeeastudio2012@gmail.com</p>
      <p> Phone: +91 9426444135</p>
      <p> Rajkot, Gujarat, India</p>
    </div>

    <!-- Social Links -->
    <div class="footer-section">
      <h4>Follow Us</h4>
      <div class="social-icons">
        <a href="https://www.facebook.com/profile.php?id=100070123291556"><img src="images/logo-icon/fb.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/jeea_studio/"><img src="images/logo-icon/insta.png" alt="Instagram"></a>
        <a href="https://www.youtube.com/@happinesslife2070"><img src="images/logo-icon/youtube.png" alt="YouTube"></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; <?php echo date("Y"); ?> JEEA's Studio. All Rights Reserved.</p>
   
  </div>
</footer>

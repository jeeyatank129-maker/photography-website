
<?php
session_start();
session_unset();
session_destroy();

// Disable caching again for safety
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Location: home.php");
exit();
?>

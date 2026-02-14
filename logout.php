<?php
session_start();
session_destroy(); // Clear the session
header('Location: landingpage.php'); // Redirect to homepage
exit;
?>
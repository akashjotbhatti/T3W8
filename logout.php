<?php
// start the session
session_start();
// destroy the session, get rid of the users login information
session_destroy();
// direct the user to login page
header('location: login.php');
?>
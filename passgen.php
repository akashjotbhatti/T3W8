<?php
// set password entered
$pass = "abc123";

// get a secure password from the one entered
echo password_hash($pass, PASSWORD_DEFAULT);
?>
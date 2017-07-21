<?php
include('config/database.php');
$connection = mysqli_connect($DB_DSN, $DB_USER, $DB_PASSWORD, 'camagru') or die(mysqli_error($connection));
?>
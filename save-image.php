<?php
require_once('connect.php');
session_start();
if (isset($_SESSION['logged'])) {
	$dataURL = $_POST["image"];
    // the dataURL has a prefix (mimetype+datatype) 
    // that we don't want, so strip that prefix off
    $parts = explode(',', $dataURL);  
    $image = $parts[1];
    // Decode base64 image, resulting in an image
    $image = base64_decode($image);
    $imagePath = "images-gallery/" . uniqid() . '.png';
    $success = file_put_contents($imagePath, $image);
    if ($success > 0) {
    	$userId = $connection->query("SELECT Id FROM users WHERE Email='" . $_SESSION['email'] . "'");
    	$userId = mysqli_fetch_assoc($userId);
    	$connection->query("INSERT INTO images(UserID, ImagePath) VALUES('" . $userId['Id'] . "','" . $imagePath . "')");
    }
    $imageID = $connection->query("SELECT Id FROM images WHERE ImagePath='" . $imagePath . "'");
    $imageID = mysqli_fetch_assoc($imageID);
    $json_response = array('imagePath' => $imagePath, 'imageID' => $imageID['Id']);
    print(json_encode($json_response));
}
else {
	header("Location: login.php");
}
?>
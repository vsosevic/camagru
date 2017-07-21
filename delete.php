<?php
session_start();
require_once('connect.php');
if ($_SESSION['logged']) {
	if(isset($_REQUEST['imageID'])) {
		$imagePath = $connection->query("SELECT ImagePath FROM images WHERE Id='". $_REQUEST['imageID'] ."'");
		$imagePath = mysqli_fetch_assoc($imagePath);
		unlink($imagePath['ImagePath']);
		$connection->query("DELETE FROM images WHERE Id='" . $_REQUEST['imageID'] . "' AND UserID='" . $_SESSION['UserID'] . "'");
	}
	header("Location:myCamagru.php");
}
else {
	header('Location:login.php');
}
?>
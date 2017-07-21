<?php
session_start();
require_once('connect.php');
header("Location:image-page.php?imageID=" . $_REQUEST['imageID']);
if (isset($_POST) && $_REQUEST['imageID'] && $_POST['comment-text'] || true) {
	$connection->query("INSERT INTO comments (UserID, ImageId, Comment) VALUES ('" . $_SESSION['UserID'] . "', '" . $_REQUEST['imageID'] . "', '" . $_POST['comment-text'] . "')");
	//retreive image owner's email from DB
	$imageOwnerEmail = $connection->query("SELECT email FROM `users`
		INNER JOIN images ON users.Id=images.UserID
		WHERE images.Id=" . $_REQUEST['imageID']);
	$imageOwnerEmail = mysqli_fetch_assoc($imageOwnerEmail);
	$mailSubject = "New comment on your image";
	$mailBody = "Hi!\n\n You've received a new comment from user ". $_SESSION['name'] .": '". $_POST['comment-text'] ."'\n\n To see the comment on your page, please follow the link: http://localhost:8080/" . explode('/', $_SERVER['REQUEST_URI'])['1'] . "/image-page.php?imageID=" . $_REQUEST['imageID'];
	mail($imageOwnerEmail['email'], $mailSubject, $mailBody);
}
?>
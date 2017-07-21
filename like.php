<?php
session_start();
require_once('connect.php');

if ($_REQUEST['like'] == 1)
{
	$connection->query("UPDATE images SET Likes = Likes + 1 WHERE Id ='". $_REQUEST['imageID'] ."'");
}
else {
	$connection->query("UPDATE images SET Likes = Likes - 1 WHERE Id ='". $_REQUEST['imageID'] ."'");
}
$numberOfLikes = $connection->query("SELECT Likes FROM images WHERE Id ='". $_REQUEST['imageID'] ."'");
$numberOfLikes = mysqli_fetch_assoc($numberOfLikes);
echo $numberOfLikes['Likes'];
?>
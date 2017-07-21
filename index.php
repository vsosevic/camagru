<?php
include('header.php');
require('connect.php');

$imagesPerPage = 6;
$pageNumber = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
//data for succesive pages
$imagesInDB = $connection->query("SELECT count(*) as total FROM images");
$imagesInDB = mysqli_fetch_assoc($imagesInDB);
$succesivePages = ceil($imagesInDB['total'] / $imagesPerPage);
if ($imagesInDB['total'] < 1) {
	echo "<div class='errmsg' style='display: block; text-align: center;'>Nothing to show yet ;( Make your first photo <a href='myCamagru.php'>here!</a></div>";
	exit();
}
//output all images
$images = $connection->query("SELECT * FROM images ORDER BY ImageDate DESC LIMIT ". $imagesPerPage ." OFFSET " . (($pageNumber - 1) * $imagesPerPage));
echo "<div class='main-gallery'>";
foreach ($images as $image) {
	echo "<a href='image-page.php?imageID=". $image['Id'] ."'><img class='user-images-gallery' src='" . $image['ImagePath'] . "'></a>";
}
echo "</div>";


//output succesive page links
if ($succesivePages > 1) {
	$i = 1;
	echo "<hr><div class='succesive-pages-div'>Pages:";
	while ($i <= $succesivePages) {
		echo "<a class='succesive-pages' href='index.php?page=". $i ."'>". $i ."</a>";
		$i++;
	}
	echo "</div>";
}
include('footer.php');
?>

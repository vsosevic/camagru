<?php
require_once('connect.php');
if (isset($_REQUEST['validationKey'])) {
	$validationKey = $_REQUEST['validationKey'];
	$result = $connection->query("SELECT * FROM users WHERE md5('42' + email) = '" . $validationKey . "'");
	$resArr = mysqli_fetch_assoc($result);
	if (isset($resArr['Email'])) {
		$connection->query("UPDATE users SET active=1 WHERE email = '" . $resArr['Email'] . "'");
		$message = "Your account activated successfully!";
	}
	else {
		$errmsg = "Invalid link!";
	}
}
?>

<html>
<head>
</head>
<body>

<?php 

include ('header.php');

if (!empty($message)) {
		echo "<span class='message'>$message Now you can <a href='login.php'>Login</a></span>";
		} 
		else { 
			echo "<span class='errmsg'>$errmsg</span>";
		}

include ('footer.php');
?>

</body></html>
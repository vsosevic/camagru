<?php
session_start();
require_once('connect.php');
if(isset($_POST) & !empty($_POST)) {
	$email      = mysqli_real_escape_string($connection,$_POST['email']);
	$_SESSION['email'] = $email;
	$password   = mysqli_real_escape_string($connection,$_POST['password']);
	$query = "SELECT * FROM users where email='".$email."' and password='".hash('whirlpool', $password)."'";
	$result = mysqli_query($connection,$query);
	$numResults = mysqli_num_rows($result);
	$array_from_query = mysqli_fetch_assoc($result);
	if ($array_from_query['Active'] === '0') {
	    $errmsg = "Your account isn't activated yet! Check you email please and activate an account";
	}
	elseif($numResults >= 1)
	{
		$name = $array_from_query['Name'];
	    $_SESSION['name'] = $name;
	    $_SESSION['logged'] = "true";
	    $_SESSION['UserID'] = $array_from_query['Id'];
	    $message = $email."Login Sucessfully!";
	    header("Location: index.php");
	}
	else
	{
	    $errmsg = " Invalid email or password!";
	}
}
?>

<!-- <html>
<head>
	<title>Login to myCamagru</title>
</head>
<body> -->

<?php include ('header.php'); ?>

<form method="post" style="align-content: center;" action="login.php">
	<h2>Login</h2>
	<input type="email" name="email" placeholder="Email" value="<?PHP echo $_SESSION['email'] ?>" />
	<br />
	<input type="Password" name="password" placeholder="Enter Password" value="" />
	<br />
	<input class="login" type="submit" name="submit" value="Login" />
	<br />
	<a href="forgot.php" style="font-size: 12px;">Forgot password?</a>
	<br />
<div class="errmsg"><?php echo $errmsg; ?></div>
</form>

<?php include ('footer.php'); ?>


<!-- </body></html> -->
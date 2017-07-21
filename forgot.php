<?php
    require_once('connect.php');
    if(isset($_POST) & !empty($_POST)){
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $query = "SELECT * FROM users where email='".$email."'";
        $result = mysqli_query($connection,$query);
        $numResults = mysqli_num_rows($result);

        if($numResults >= 1) {
            $r = mysqli_fetch_assoc($result);
            $name = $r['Name'];
            $password = $r['Password'];
            $forgotKey = md5('42' + $email);
            $mailSubject = "Forgot password on camagru!";
            $mailBody = "Hi, $name!\n\n Please enter your new password and the reset key:\n\n" . $forgotKey . "\n\n in the following link: http://localhost:8080/" . explode('/', $_SERVER['REQUEST_URI'])['1'] . "/forgot-reset.php";
            if (mail($email, $mailSubject, $mailBody)) {
                 $message = "Mail was sent!";
                 // alert("Mail was sent.");
            }
            else {
                $message = "Some error with sending email to your address.";
            }
        }
        header("Location: forgot-reset.php");
}
?>

<html>
<head>
</head>
<body>

<?php include ('header.php'); ?>

<form class="form-forgot" method="POST" action="forgot.php">
        <h2 class="form-forgot-heading">Forgot Password</h2>
        <span class="form-forgot-text">Enter your email, push the "Forgot Password" button and then check your email.</span>
        <div class="input-group-forgot">
      <input type="text" name="email" class="input-email-forgot" placeholder="Email" required>
    </div>
    <br />
        <button class="btn-forgot" type="submit">Forgot Password</button>
        <!-- <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a> -->
      </form>

<?php include ('footer.php'); ?>

</body></html>
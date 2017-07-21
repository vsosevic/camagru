<?php
    require_once('connect.php');
    require_once('includes/lib.inc.php');
    if(isset($_POST) & !empty($_POST)){
        if (!empty($errmsg = checkPassword($_POST['new-password']))) {
            $errmsg = implode(" ", $errmsg);
        }
        else {
            $forgotKey = mysqli_real_escape_string($connection, $_POST['forgotKey']);
            $query = "SELECT * FROM users WHERE md5('42' + email) = '" . $forgotKey . "'";
            $result = mysqli_query($connection,$query);
            $numResults = mysqli_num_rows($result);
            if($numResults >= 1) {
                $resArr = mysqli_fetch_assoc($result);
                $query = "UPDATE users SET password=".hash('whirlpool', $_POST['new-password'])." WHERE email = '" . $resArr['Email'] . "'";
                $connection->query("UPDATE users SET password='".hash('whirlpool', $_POST['new-password'])."' WHERE email = '" . $resArr['Email'] . "'");
                $message = 'Your password changed sucessfully <a href="login.php">Click here to login</a>.';
            }
            else {
                $errmsg = "Reset link is wrong!";
            }
        }
}
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php include ('header.php'); ?>

    <form class="form-forgot" method="POST" action="forgot-reset.php">
        <h2 class="form-forgot-heading">Password reset</h2>
        <p class="form-forgot-text">Enter your new password and reset key from email.</p>
        <div class="input-group-forgot">
            <input type="Password" name="new-password" placeholder="Enter new password" value="" required />
            <span class="errmsg"><?php echo $errmsg; ?></span>
            <br />
            <input type="Text" name="forgotKey" placeholder="Reset key from email" value="" required />
            <br />
        </div>
        <br />
        <button class="btn-submit-reset-password" type="submit">Reset password</button>
    </form>
    <span class="errmsg"><?php echo $errmsg; ?></span>
    <span class="message"><?php echo $message; ?></span>

<?php include ('footer.php'); ?>

</body></html>
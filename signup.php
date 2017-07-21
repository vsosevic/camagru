<?php
require_once('includes/lib.inc.php');
require_once('connect.php');
session_start();
if(isset($_POST) & !empty($_POST)) {
    $name       = mysqli_real_escape_string($connection,$_POST['name']);
    $email      = mysqli_real_escape_string($connection,$_POST['email']);
    $password   = mysqli_real_escape_string($connection,$_POST['password']);
    $query = "SELECT email FROM users where email='".$email."'";
    $result = mysqli_query($connection,$query);
    $numResults = mysqli_num_rows($result);
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $errmsg =  "Invalid email address. Please type a valid email!";
        $_SESSION['email'] = "";
    }
    elseif($numResults>=1)
    {
        $errmsg = $email." - user with this email already exists! Choose another one.";
    }
    elseif ($_POST['password'] !== $_POST['password-again']) {
        $errmsg = "Passwords don't match! Please retype your passwords";
    }
    elseif (!empty($errmsg = checkPassword($password))) {
        $errmsg = implode(" ", $errmsg);
    }
    else
    {
        $validationKey = md5('42' + $email);
        $mailSubject = "Signing up to camagru - validate your account!";
        $mailBody = "Hi, $name!\n\n To validate your account click the following link: http://localhost:8080/" . explode('/', $_SERVER['REQUEST_URI'])['1'] . "/validation.php?validationKey=" . $validationKey;
        if (mail($email, $mailSubject, $mailBody)) {
            $connection->query("INSERT INTO users(name,email,password) VALUES('".$name."','".$email."','".hash('whirlpool', $password)."')");
            $message = "Signup Sucessfully! To finish registration check your email!";
        }
        else {
            $errmsg .= "Sign up failed! Some error with sending email to your address. Try again later.";
        }
    }
}
?>

<html>
<head>
    <title>Signing up to Camagru</title>
</head>
<body>

<?php include ('header.php'); ?>

<form method="post" style="align-content: center;" action="signup.php">
    <h2>SignUp</h2>
    <input type="text" name="name" placeholder="Name" value="<?PHP echo $_SESSION['name'] ?>" required />
    <br />
    <input type="email" name="email" placeholder="Email" value="<?PHP echo $_SESSION['email'] ?>" required />
    <br />
    <input type="Password" name="password" placeholder="Enter Password" value="" required />
    <br />
    <input type="Password" name="password-again" placeholder="Password again" value="" required />
    <br />
    <input class="login" type="submit" name="submit" value="Subscribe" />
    <br />
    <div class="errmsg"><?php echo $errmsg; ?></div>
    <div class="message"><?php echo $message; ?></div>
</form>


<?php include ('footer.php'); ?>

</body></html>
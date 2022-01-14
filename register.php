<?php
require_once("./.lib-common.php");
require_once("./.lib-connection.php");
require_once("./.lib-auth.php");

$username = "";
$email = "";
$password = "";

if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['email'])) $email = $_POST['email'];
if (isset($_POST['password1'])) $password1 = $_POST['password1'];
if (isset($_POST['password2'])) $password2 = $_POST['password2'];

$registerMessage = "";
if ($username !== "" && $email !== "" && $password1 !== "" && $password2 !== "") {
    if ($password1 !== $password2) {
        $registerMessage = "Passwords Do Not Match <br/>";
    } else {
        $registerMessage = UserManagement::RegisterUser($username, $password1, $email);
        if ($registerMessage === "") {
            Request::RedirectTo(_CONFIRM_EMAIL_PAGE);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        form {
            text-align: center;
            font-size: 125%;
            padding: 75px 0px;
        }

        form input {
            font-size: 100%;
            text-align: center;
            padding: 5px;
        }

        form div {
            padding: 5px 0px;
        }

        .red {
            color: red;
        }
    </style>
</head>

<body>

    <form method="POST" action="">
        <div>
            <input id="username" name="username" type="text" placeholder="Username" value="<?php echo ($username); ?>" />
        </div>
        <div>
            <input id="email" name="email" type="text" placeholder="Email" value="<?php echo ($email); ?>" />
        </div>
        <div>
            <input id="password1" name="password1" type="password" placeholder="Create Password" value="<?php echo (""); ?>" />
        </div>
        <div>
            <input id="password2" name="password2" type="password" placeholder="Repeat Password" value="<?php echo (""); ?>" />
        </div>
        <div>
            <input type="submit" value="Register" />
        </div>
        <?php
        if ($registerMessage !== "") {
            echo ("<div class='red'>" . $registerMessage . "</div>");
        }
        ?>
        <div>
            Already have an account? <a href="<?php echo (_LOGIN_PAGE); ?>">login</a>
        </div>
    </form>

    <?php

    ?>
</body>

</html>
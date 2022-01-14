<?php
require_once("./.lib-common.php");
require_once("./.lib-connection.php");
require_once("./.lib-auth.php");

SignInManager::SignOut();

$username = "";
$password = "";

if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['password'])) $password = $_POST['password'];

$loginMessage = "";
if ($username !== "" && $password !== "") {
    $loginMessage = UserManagement::CheckLogin($username, $password);
    if ($loginMessage === "") {
        SignInManager::SignIn($username);
        Request::RedirectTo(_WEBSITE_ROOT);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <input id="password" name="password" type="password" placeholder="Password" value="<?php echo (""); ?>" />
        </div>
        <div>
            <input type="submit" value="Login" />
        </div>
        <?php
        if ($loginMessage !== "") {
            echo ("<div class='red'>" . $loginMessage . "</div>");
        }
        ?>
        <div>
            Don't have an account? <a href="<?php echo (_REGISTER_PAGE); ?>">register</a>
        </div>
    </form>

    <?php

    ?>
</body>

</html>
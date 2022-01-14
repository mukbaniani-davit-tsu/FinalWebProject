<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Email</title>
</head>

<body>
    <?php
    require_once("./.lib-connection.php");

    if (!isset($_GET['secret'])) {
        echo ("Please check your inbox to confirm your email (you may be able to find it in spam section)");
    } else {
        $secret = $_GET['secret'];
        if (UserManagement::VerifyEmail($secret)) {
            Request::RedirectTo(_LOGIN_PAGE);
            echo ("Email confirmed successfully, please login");
        } else {
            echo ("Email couldn't be confirmed");
        }
    }

    ?>

</body>

</html>
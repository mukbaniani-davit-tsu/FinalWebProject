<?php

require_once("./.lib-constants.php");
require_once("./.lib-common.php");
require_once("./.lib-auth.php");
require_once("./.lib-connection.php");

SignInManager::EnsureLoggedIn();
$username = $GLOBALS['user'];

$fileId = "";
if(isset($_GET['id'])) $fileId = $_GET['id'];
if(isset($_POST['id'])) $fileId = $_POST['id'];

if($fileId == "") Request::ExitWithError("File Id Not Specified");

if(!FileManagement::CheckAccess($fileId, $username)) Request::ExitWithError("Permission Denied");

$title = "";
$description = "";

if (isset($_POST['title'])) $title = $_POST['title'];
if (isset($_POST['description'])) $description = $_POST['description'];

$editMessage = "";
if ($title !== "" && $description !== "") {
    $editMessage = FileManagement::EditFile($fileId, $title, $description);
    if ($editMessage === "") {
        Request::RedirectTo(_WEBSITE_ROOT);
    }
}

$info = FileManagement::GetFileInfo($fileId, $username);
if($title === "") $title = $info["title"];
if($description === "") $description = $info["description"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit File</title>
</head>

<body>

    <form method="POST" action="" enctype="multipart/form-data">
        <input id="title" name="title" type="text" placeholder="Title" value="<?php echo ($title); ?>" />
        <input id="description" name="description" type="text" placeholder="Description" value="<?php echo ($description); ?>" />
        <input type="submit" />
        <?php
        if ($editMessage !== "") {
            echo ("<div>" . $editMessage . "</div>");
        }
        ?>
    </form>

    <?php

    ?>
</body>

</html>
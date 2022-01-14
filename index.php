<?php

require_once("./.lib-constants.php");
require_once("./.lib-common.php");
require_once("./.lib-auth.php");
require_once("./.lib-connection.php");

SignInManager::EnsureLoggedIn();
$username = $GLOBALS['user'];

$list = FileManagement::GetFileList($username);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Files</title>
    <style>
        #navbar {
            padding: 10px 25px;
            font-size: 125%;
            text-align: right;
        }

        #userbar {
            display: inline;
        }

        #logoutbar {
            padding: 10px 0px;
        }

        .list-wrapper {
            padding: 10px 0px;
            text-align: center;
        }

        .outer-wrapper {
            display: inline-block;
        }

        #upload-button {
            font-size: 115%;
            font-weight: bold;
            text-align: center;
            padding-bottom: 25px;
        }

        #upload-button a {
            text-decoration: none;
            color: black;
        }

        table tr td,
        table tr th {
            font-size: 115%;
            padding: 5px 15px;
        }

        .action-td a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

    <div id="navbar">
        <div id="userbar">Hello <?php echo ($username); ?></div>
        <div id="logoutbar"><a href="<?php echo (_LOGOUT_PAGE); ?>">Logout</a></div>
    </div>

    <div id="upload-button"><a href="<?php echo(_UPLOAD_PAGE); ?>">[ + Upload New File ]</a></div>
    <div class="list-wrapper">
        <div class="outer-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Download</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $file) {
                    ?>
                        <tr>
                            <td><?php echo ($file["user"] == $GLOBALS['user'] ? "[ME]" : $file["user"]); ?></td>
                            <td><?php echo ($file["title"]); ?></td>
                            <td><?php echo ($file["description"]); ?></td>
                            <td><a href="<?php echo ($file["url"]); ?>" download><?php echo ($file["url"]); ?></a></td>
                            <td class="action-td">
                                <a href="<?php echo (_EDIT_PAGE . "?id=" . $file["id"]); ?>">[edit]</a>
                                &nbsp;<a href="<?php echo (_DELETE_PAGE . "?id=" . $file["id"]); ?>">[delete]</a>
                                &nbsp;<a href="<?php echo (_DELETE_PAGE . "?id=" . $file["id"]); ?>">[share]</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
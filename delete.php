<?php

require_once("./.lib-constants.php");
require_once("./.lib-common.php");
require_once("./.lib-auth.php");
require_once("./.lib-connection.php");

SignInManager::EnsureLoggedIn();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $GLOBALS['user'];
    if (FileManagement::CheckAccess($id, $user)) {
        FileManagement::DeleteFile($id);
    }
}

Request::RedirectTo(_WEBSITE_ROOT);

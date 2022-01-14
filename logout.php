<?php

require_once("./.lib-constants.php");
require_once("./.lib-common.php");
require_once("./.lib-auth.php");

SignInManager::SignOut();
Request::RedirectTo(_WEBSITE_ROOT);

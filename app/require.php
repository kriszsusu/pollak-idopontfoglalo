<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'on');

//Require libraries from folder libraries
require_once 'libraries/Core.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';

require_once 'helpers/session_helper.php';

require_once 'config/config.php';

//Instantiate core class
$init = new Core();

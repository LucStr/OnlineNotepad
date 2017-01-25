<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "onlinenotepad");

define("PATH_INC", "include/");
define("PATH_MOD", "include/modules/");

include(PATH_MOD . "db.php");
include(PATH_MOD . "session.php");
include(PATH_MOD . "cookies.php");
include(PATH_MOD . "header.php");
include(PATH_INC . "security.php");
include(PATH_INC . "action.php");
?>

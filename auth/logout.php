<?php

session_start();
$_SESSION = array();
setcookie(session_name(), "", 100);
session_unset();
session_destroy();
header("Location: /login.php", true, 301);
exit();

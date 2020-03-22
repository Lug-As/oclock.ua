<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__) );
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/oclock/core");
define("LIBS", ROOT . "/vendor/oclock/core/libs");
define("CASH", ROOT . "/tmp/cache");
define("CONF", ROOT . "/config");
define("LAYOUT", "default");

$path = "http";
if (isset($_SERVER["HTTPS"]) and $_SERVER["REQUEST_SCHEME"] == "https") {
	$path .= "s";
}
$path .= "://";
$path .= $_SERVER["HTTP_HOST"];

define("PATH", $path);
define("ADMIN", PATH . "/admin");

require_once ROOT . "/vendor/autoload.php";
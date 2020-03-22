<?php

require_once dirname(__DIR__) . "/config/init.php";
require_once LIBS . "/functions.php";

new \oclock\App();
\oclock\App::$app->setProperty("What the", "Fuck");
deb(\oclock\App::$app->getProperties());
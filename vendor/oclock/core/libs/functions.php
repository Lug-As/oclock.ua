<?php

function debug($var, $title = "")
{
	echo "<pre>";
	if ($title != "") {
		echo ucfirst($title) . ": ";
	}
	echo print_r($var, true) . "</pre>";
}

function getRlogs()
{
	$logs = \RedBeanPHP\R::getDatabaseAdapter()
		->getDatabase()
		->getLogger();

	debug($logs->grep('SELECT'));
	return $logs;
}

function redirect($http = false)
{
	if ($http) {
		$redirect = $http;
	} else {
		$redirect = $_SERVER['HTTP_REFERER'] ?? PATH;
	}
	header("Location: {$redirect}");
	die;
}

function safeHtmlChars($string)
{
	return htmlspecialchars($string, ENT_QUOTES);
}

function generate_hash($length = '32')
{
	$symbol = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890@$&.";
	$code = "";
	for ($i = 0; $i < $length; $i++) {
		$code .= $symbol[rand(0, strlen($symbol) - 1)];
	}
	return $code;
}

function checkUserHash($id, $hash)
{
	$user = \RedBeanPHP\R::load('user', $id);
	if ($user) {
		if ($user->hash === $hash) {
			return true;
		}
	}
	return false;
}
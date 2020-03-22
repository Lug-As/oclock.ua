<?php

function deb($var, $title = "")
{
	echo "<pre>";
	if ( $title != "" ) {
		echo ucfirst($title) . ": ";
	}
	echo print_r($var, true) . "</pre>";
}
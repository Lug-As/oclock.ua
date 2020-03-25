<?php

function debug($var, $title = "")
{
	echo "<pre>";
	if ( $title != "" ) {
		echo ucfirst($title) . ": ";
	}
	echo print_r($var, true) . "</pre>";
}

function getRlogs(){
    $logs = \RedBeanPHP\R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();

    debug( $logs->grep( 'SELECT' ) );
    return $logs;
}
<?php

function __autoload( $class ){
	if( file_exists( "Class/{$class}.php" ) ){
		include "Class/{$class}.php";
	}
}

function safeName( $name ){
	return md5( $name );
}

// This is just an example function to show how configs could be cut down. Modification of this function
// will modify all the graphs queries.
function ExampleGenSql( $y, $name ){
	return "SELECT time, {$y} from machine WHERE name='{$name}' order by time desc limit 200";
}

$simpleMysql	= new SimpleMysql( "host", "user", "pass", "database" );
$graphArray	= array(	"Load Average"	=> array(	"Core01" => $simpleMysql->getXYFromTable( ExampleGenSql( "loadAverage", "core01" ) ),
								"Core02" => $simpleMysql->getXYFromTable( ExampleGenSql( "loadAverage", "core02" ) ),
								"NotDesktop" => $simpleMysql->getXYFromTable( ExampleGenSql( "loadAverage", "notdesktop" ) ) ),

				"Process count" => array(	"Core01" => $simpleMysql->getXYFromTable( ExampleGenSql( "processCount", "core01" ) ),
								"Core02" => $simpleMysql->getXYFromTable( ExampleGenSql( "processCount", "core02" ) ),
								"NotDesktop" => $simpleMysql->getXYFromTable( ExampleGenSql( "processCount", "notdesktop" ) ) ) );
?>

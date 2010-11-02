<?php
/*
    This file is part of mfp.

    mfp is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    mfp is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with mfp.  If not, see <http://www.gnu.org/licenses/>.
*/

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
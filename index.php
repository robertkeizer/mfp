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

include './config.php';
?>
<html>
	<head>
		<title>Stats</title>
		<link href='include/style.css' rel='stylesheet' type='text/css'>
		<script type='text/javascript' src='include/jquery.js'></script>
		<script type='text/javascript' src='include/jquery.flot.js'></script>
		<?php
		foreach( $graphArray as $graphName => $graphItemTotal ){
			$tmpGraphInstance = new FlotGraph( $graphItemTotal['data'], safeName( $graphName ) );
			foreach( $graphItemTotal['options'] as $func => $arg ){
				$tmpGraphInstance->$func($arg);
			}
			echo $tmpGraphInstance->getJavascript(); 
		}
		?>
	</head>
	<body>
		<?php
		foreach( $graphArray as $graphName => $graphItemArray ){
			echo "<h2>{$graphName}</h2>\n";
			echo "<div id='".safeName($graphName)."' style='width:600px; height:150px;'></div>\n";
		}
		?>
	</body>
</html>

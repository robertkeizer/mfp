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

include './Class/FlotGraph.php';
include './Class/SimpleMysql.php';

$simpleMysql	= new SimpleMysql( "mysqlHost", "mysqlUser", "mysqlPass", "mysqlDatabase" );
$dataArray	= array( "GraphTitle" => $simpleMysql->getXYFromTable( "xField", "yField", "mysqlTable", "orderBy", 500 ) );
$FlotGraph	= new FlotGraph( $dataArray, "htmlPlaceholder" );
?>
<html>
	<head>
		<title>Example</title>
		<link href='include/style.css' rel='stylesheet' type='text/css'>
		<script type='text/javascript' src='include/jquery.js'></script>
		<script type='text/javascript' src='include/jquery.flot.js'></script>
		<?php echo $FlotGraph->getJavascript(); ?>
	</head>
	<body>
		<h2>Example Graph</h2>
		<div id='htmlPlaceholder' style='width:600px; height:150px;'></div>
	</body>
</html>

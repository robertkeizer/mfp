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

$simpleMysql	= new SimpleMysql( "host", "user", "pass", "database" );

									// xField, yField, mysql table name, order query by, query result limit.
$dataArray	= array( "Graph Title" => $simpleMysql->getXYFromTable( "xField", "yField", "MysqlTableName", "orderBy", 200 ) );

				// dataArray, html placeholder id.
$myFlotGraph	= new FlotGraph( $dataArray, "test" );
?>
<html>
	<head>
		<title>Examples</title>
		<script type='text/javascript' src='include/jquery.js'></script>
		<script type='text/javascript' src='include/jquery.flot.js'></script>
		<?php echo $myFlotGraph->getJavascript(); ?>
	</head>
	<body>
		<h2>Simple Example</h2>
		<div id='test' style='width:600px; height:150px;'></div>
	</body>
</html>

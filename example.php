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

// Create a new Instance of SimpleMysql. Specify the host, user, pass and database.
$simpleMysql	= new SimpleMysql( "host", "user", "pass", "database" );
/* Create a new dataArray, setting the graph title(s) and
   the xyArray(s). */
$dataArray	= array( "Graph Title" => $simpleMysql->getXYFromTable( "x", "y", "table", "x", 200 ),
			 "Another Graph" => array(	1 => 5,
							2 => 2,
							3 => 51,
							4 => 12,
							5 => 7 )
		);
/* Create the graph instance using the data array and the 
   HTML id value to graph to. */
$myFlotGraph	= new FlotGraph( $dataArray, "test" );
?>
<html>
	<head>
		<title>Examples</title>
		<!-- Include both jquery and jquery.flot -->
		<script type='text/javascript' src='include/jquery.js'></script>
		<script type='text/javascript' src='include/jquery.flot.js'></script>
		<!-- Call the function to generate valid flot javascript. -->
		<?php echo $myFlotGraph->getJavascript(); ?>
	</head>
	<body>
		<h2>Simple Example</h2>
		<!-- Specify a width and height, and an id. -->
		<div id='test' style='width:600px; height:150px;'></div>
	</body>
</html>

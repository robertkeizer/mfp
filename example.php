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
include './FlotGraph.php';

$dataArray	= array( "TestStuff1" => array( 1 => 20,
						2 => 23,
						3 => 24,
						4 => 28,
						5 => 82,
						6 => 18 ),
			"TestStuff2" => array(	1 => 11,
						2 => 25,
						3 => 8,
						4 => 9,
						5 => 1,
						6 => 50 ) );

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

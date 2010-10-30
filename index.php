<?php

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
		<title>Testing</title>
		<script type='text/javascript' src='include/jquery.js'></script>
		<script type='text/javascript' src='include/jquery.flot.js'></script>
		<?php echo $myFlotGraph->getJavascript(); ?>
	</head>
	<body>
		<h2>Testing</h2>
		<div id='test' style='width:600px; height:150px;'></div>
	</body>
</html>

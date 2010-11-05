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
		<script type='text/javascript'>
			$(document).ready( function( ){
				$(".graphContainer:odd").css( {'background-color': '#eee', 'border': '1px solid #ccc'} );
				$(".graphContainer:odd").children(".graphPlaceholder").css( {'background-color': '#fff', 'border': '1px solid #ccc'} );
			} );
		</script>
	</head>
	<body>
		<table cellspacing='4' cellpadding='4'>
			<tr>
				<td align='left' valign='top'>
					<p>This is <span class='big'>mfp</span> ( Mysql-Flot-PHP ).</p>
					<p>Written in PHP, <span class='big'>mfp</span> provides easy integration between MySQL and Flot. As you can see to the right if you have javascript enabled, a full range of graph types can be rendered. All rendering is done on the client side, making <span class='big'>mfp</span> ideal for large scale operations.</p>
					<p>Server requirements are fairly low, a web server with PHP loaded, and the PHP5-MySQL module are the only requirements. Obviously on the client side, a recent browser is required. See <a href='http://code.google.com/p/flot/'>flot</a> for supported browser listings.</p>
					<p><span class='big'>mfp</span> is licensed under the GNU GPLv3, and is freely available to anyone interested.</p>
					<p><span class='big'>mfp</span> source is available at the <a href='http://github.com/robertkeizer/mfp/'>github project page</a>.</p>
				</td>
				<td align='left'>
					<?php
					foreach( $graphArray as $graphName => $graphStuff ){
						echo "<div class='graphContainer'>\n";
						echo "\t<table>\n";
						echo "\t<tr>\n";
						echo "\t<td class='big'>{$graphName}</td>\n";
						echo "\t<td id='".safeName($graphName)."_legend' align='right'></td>\n";
						echo "\t</tr><tr><td colspan='2'>\n";
						echo "\t<div class='graphPlaceholder' id='".safeName($graphName)."' style='width:600px; height:100px;'></div>\n";
						echo "\t</td></tr></table>\n";
						echo "</div>\n";
					}
					?>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</body>
</html>

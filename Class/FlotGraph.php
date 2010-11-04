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

class FlotGraph{

	private $_dataArray;
	private $_placeHolder;
	private $_timeVar = null;
	private $_legendPosition = "nw";
	private $_enableLines = true;
	private $_enablePoints = false;
	private $_enableBars = false;
	private $_legendContainer = null;
	private $_numLegendColumns = 1;
	private $_lineFill = false;

	public function __construct( Array $dataArray, $placeHolder ){
		$this->_dataArray	= $dataArray;
		$this->_placeHolder	= $placeHolder;
	}

	public function setTimeVar( $var ){
		if( strtolower( $var ) == 'x' || strtolower( $var ) == 'y' ) {
			$this->_timeVar = $var;
		}
	}
	
	public function setLegendPosition( $position ){
		$this->_legendPosition	= $position;
	}

	public function enablePoints( ){
		$this->_enablePoints	= true;
	}

	public function disablePoints( ){
		$this->_enablePoints	= false;
	}

	public function enableBars( ){
		$this->_enableBars	= true;
	}

	public function disableBars( ){
		$this->_enableBars	= false;
	}

	public function enableLines( ){
		$this->_enableLines	= true;
	}
	
	public function disableLines( ){
		$this->_enableLines	= false;
	}

	public function setLegendContainer( $container ){
		$this->_legendContainer = $container;
	}

	public function setNumLegendColumns( $num ){
		$this->_numLegendColumns = $num;
	}

	public function enableLineFill( ){
		$this->_lineFill = true;
	}

	public function disableLineFill( ){
		$this->_lineFill == false;
	}

	public function getJavascript( ){
		// A temporary array to store dataArrayNames..
		$dataArrayNames	= array();
		// Start the returnString.. 
		$returnString	= "<script type='text/javascript'>\n";
		// Run through each dataArray..
		foreach( $this->_dataArray as $dataArrayName => $xyArray ){

			// Use json_encode.. then go through and replace ":" with , and add [ ]'s
			$tmpJsonData	= json_encode($xyArray);
			$tmpJsonData	= str_replace( ',', "],[", $tmpJsonData );
			$tmpJsonData	= str_replace( ":", ",", $tmpJsonData );
			$tmpJsonData	= str_replace( '{', '[[', $tmpJsonData );
			$tmpJsonData	= str_replace( '}', ']]', $tmpJsonData );
			$tmpJsonData	= str_replace( '"', '', $tmpJsonData );

			// Append the data for the xyArray to returnString
			$returnString	.= "var {$dataArrayName}_data = {$tmpJsonData};\n";
			// Make sure to note the dataArrayName, since we're already here.
			$dataArrayNames[]		= $dataArrayName;
		}

		// Make the master js array which has all the other arrays as elements..
		$returnString	.= "var {$this->_placeHolder}_data = [ ";
		for( $tmpCounter=0; $tmpCounter<count( $dataArrayNames ); $tmpCounter++ ){

			$returnString .= "{ data: {$dataArrayNames[$tmpCounter]}_data, label: \"{$dataArrayNames[$tmpCounter]}\" }";
			// This is so that only the last item in the array doesn't get a ,
			if( $tmpCounter != count( $dataArrayNames )-1 ){
				$returnString .= ", ";
			}

		}
		$returnString	.= " ];\n";
		
		// Append the graph function to returnString using the placeHolder variable.

		// Open ended for a reason, namely to check if time is set..
		$returnString	.= "$(function(){\n\t$.plot( $('#{$this->_placeHolder}'), {$this->_placeHolder}_data";

		// Start the options..
		$returnString	.= ", {";

			// Check if time var is set.
			if( $this->_timeVar !== null ){
				$returnString .= "{$this->_timeVar}axis: { mode: \"time\" }";
			}

			// Need to check _timeVar so that the comma is in the right spot.. this is temporary.
			// Legend..
			if( $this->_timeVar !== null ){
				$returnString .= ", legend: { ";
			}else{
				$returnString .= " legend: { ";
			}
			
			// Number of columns in the container..
			$returnString .= " noColumns: {$this->_numLegendColumns}, ";

			// Legend Container check
			if( $this->_legendContainer !== null ){
				$returnString .= "container: {$this->_legendContainer}";
			}else{
				// Position if not in a container..
				if( $this->_legendPosition !== false ){
					$returnString .= "show: true, position: \"{$this->_legendPosition}\"";
				}else{
					$returnString .= "show: false";
				}
			}

			$returnString .= "}";
			// End of legend stuff.

			// Check for lines..
			if( $this->_enableLines ){
				$returnString .= ", lines: { show: true ";
				// Check for line fill..
				if( $this->_lineFill ){
					$returnString .= ", fill: true";
				}
				$returnString .= "}";
			}else{
				$returnString .= ", lines: { show: false }";
			}

			// Check for points.
			if( $this->_enablePoints ){
				$returnString .= ", points: { show: true }";
			}else{
				$returnString .= ", points: { show: false }";
			}
			
			// Check for bars
			if( $this->_enableBars ){
				$returnString .= ", bars: { show: true }";
			}else{
				$returnString .= ", bars: { show: false }";
			}

		// End the above.. to complete the javascript. End of options..
		$returnString .= " } ); \n});";

		$returnString	.= "</script>\n";

		return $returnString;
	}
}

?>

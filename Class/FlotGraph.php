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

			// Check for where the legend should be displayed, if at all.
			$returnString .= ", legend: { ";
			if( $this->_legendPosition !== false ){
				$returnString .= "show: true, position: \"{$this->_legendPosition}\"";
			}else{
				$returnString .= "show: false";
			}
			$returnString .= "}";

		// End the above.. to complete the javascript. End of options..
		$returnString .= " } ); \n});";

		$returnString	.= "</script>\n";

		return $returnString;
	}
}

?>

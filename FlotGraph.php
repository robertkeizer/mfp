<?php

class FlotGraph{

	private $_dataArray;
	private $_placeHolder;

	public function __construct( Array $dataArray, $placeHolder ){
		$this->_dataArray	= $dataArray;
		$this->_placeHolder	= $placeHolder;
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
			$tmpJsonData	= preg_replace( '/,/', "],[", $tmpJsonData );
			$tmpJsonData	= preg_replace( "/:/", ",", $tmpJsonData );
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
			// If we are not at the last one..
			if( $tmpCounter != count( $dataArrayNames )-1 ){
				$returnString .= "{ data: {$dataArrayNames[$tmpCounter]}_data, label: \"{$dataArrayNames[$tmpCounter]}\" }, ";
			}else{	// Last one.
				$returnString .= "{ data: {$dataArrayNames[$tmpCounter]}_data, label: \"{$dataArrayNames[$tmpCounter]}\" }";
			}
		}
		$returnString	.= " ];\n";
		
		// Append the graph function to returnString using the placeHolder variable.
		$returnString	.= "$(function(){\n\t$.plot($('#{$this->_placeHolder}'), {$this->_placeHolder}_data );\n});\n";
		$returnString	.= "</script>\n";

		return $returnString;
	}
}

?>

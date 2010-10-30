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

class SimpleMysql{

	private $_dbHandle;
	
	public function __construct( $host, $user, $pass, $db ){
		$this->_dbHandle	= mysql_connect( $host, $user, $pass );
		mysql_select_db( $db, $this->_dbHandle );
	}

	public function getXYFromTable( $xField, $yField, $table, $orderBy = null, $limit = 200 ){
		$table		= mysql_real_escape_string( $table );
		$xField		= mysql_real_escape_string( $xField );
		$yField		= mysql_real_escape_string( $yField );
		$limit		= mysql_real_escape_string( $limit );
		$orderBy	= mysql_real_escape_string( $orderBy );

		$tmpQuery	= "SELECT $xField, $yField FROM $table";
		if( $orderBy != null ){
			$tmpQuery .= " ORDER BY {$orderBy}";
		}
		$tmpQuery	.= " DESC LIMIT $limit";

		$result		= mysql_query( $tmpQuery );
		$returnArray	= array();
		while( $mysqlArray = mysql_fetch_array( $result, MYSQL_NUM ) ){
			$returnArray[$mysqlArray[0]] = $mysqlArray[1];
		}

		return $returnArray;
	}
}
?>


<?php

require_once("includes/dbconnect.php" );  // get our access credentials

$theDB = mysql_pconnect($hostname, $username, $password) or die(mysql_error() . mysql_errno());

mysql_select_db($database, $theDB);

$query = "SELECT eventid,title,unix_timestamp(eventtime),description from calendarevents where event_type='Lecture' ORDER BY eventtime ASC";
$result = mysql_query($query, $theDB) or die(mysql_error());
    
print <<<END
 <!doctype html>
 <html>
 <head>
 <meta charset="utf-8">
 <title>Database CAUP EVENTS</title>
 </head>
 <body>
 <p>This script extracts ALL event records and shows ALL fields (or columns) of each event.</p>
END;

$nRows = mysql_num_rows($result);
print" <h3>There are $nRows records in the calendar.</h3>";

if( $nRows>0 ){
    $n=0;
    print"<table border=1>";
	while( list($id,$title,$ts,$description ) = mysql_fetch_array($result) ){ 
		$nfields = count( $rec );

		print"<tr valign=\"top\">";
		
		   print"<td><b><a href='details.php?$id' title='$description'>$title</a></b></td>";
		   print"<td>".date('F j, Y, g:i',$ts)."</td>";
		
	    print"</tr>\n";
	}
	print"</table>\n";
	
}
print<<<END
 </body>
 </html>
END;

?>

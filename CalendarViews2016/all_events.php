<?php

require_once("includes/dbconnect.php" );  // get our access credentials

$theDB = mysql_pconnect($hostname, $username, $password) or die(mysql_error() . mysql_errno());

mysql_select_db($database, $theDB);

$query = "SELECT * from calendarevents";
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
	while( $rec = mysql_fetch_array($result) ){ 
		$nfields = count( $rec );

		print"<tr valign=\"top\">";
		if( $n == 0 ){ 
		    print"<td>[n]</td>";
		    $keys = array_keys( $rec );
			for( $i=1;$i<$nfields;$i=$i+2){
			   print"<td>".$keys[$i]."</td>";
			}
			print"</tr>\n<tr valign=\"top\">";          
		}
		$nfields = $nfields/2;
		$n=$n+1;
  		print"<td>[$n]</td>";
		for( $i=0; $i<$nfields; $i++ ){
		   $fcontents = $rec[$i];
		   if( strlen($fcontents) >25 ){ $fcontents = substr($fcontents,0,20)."..."; }
		   print"<td>".$fcontents."</td>";
		}
	    print"</tr>\n";
	}
	print"</table>\n";
	
}
print<<<END
 </body>
 </html>
END;

?>

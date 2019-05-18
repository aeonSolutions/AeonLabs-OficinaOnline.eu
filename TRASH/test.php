<?php
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"TRASH")); // file system path
include($server['root']['path'].'resources/config/database.cfg');

$db->connect(true);
$query=$db->getquery("SELECT contactID, tokenID FROM Contacts WHERE contactID='933651316'");
$db->connect(false);

echo count($query[0][0]).'<br>M:'.$query[0]['tokenID'];
for ($i = 0; $i < count($query[0]); $i++) {
	echo $query[0][$i];
	
}

?>
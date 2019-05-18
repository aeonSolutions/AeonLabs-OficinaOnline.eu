<?php
function famousQoutes(){
	$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
	$tmp=file_get_contents($server['root']['path'].'resources/config/famousquotes.txt');
	$tmp=str_replace(chr(10), chr(13), $tmp);
	$quotes=explode(chr(13), $tmp);
	$tmp=$quotes[rand(0, count($quotes)-1)];
	$selected=explode("-", $tmp);
	
	return '<p style="text-align: center;">&quot;'.$selected[0].'&quot;</br><i>'.$selected[1].'</i></p>'; 	

};
?>

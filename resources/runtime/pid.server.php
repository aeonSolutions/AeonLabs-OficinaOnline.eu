<?php
if (isset($_GET['pid']) or isset($_POST['pid'])):
	$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
	if (constant('ON_SiTe') === null):
		define('ON_SiTe', true);
	endif;
	include($server['root']['path'].'resources/config/pid.cfg');
	$pid= (isset($_GET['pid'])) ?  $_GET['pid'] : $_POST['pid'];
	if(!include($server['root']['path'].$task[$pid])):
		echo 'Bogus man, i\'m telling you! Bogus man.';
	endif;
	exit;
endif;
//continue loading main page
?>
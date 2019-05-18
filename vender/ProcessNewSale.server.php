<?php
/* 
	accepts variable $input

expected code:	
YouTube: 
	<iframe width="560" height="315" src="https://www.youtube.com/embed/D-zgtylBKUc" frameborder="0" allowfullscreen></iframe>
Flickr:
	https://www.flickr.com/gp/142718135@N05/YH3672
	https://www.flickr.com/photos/142718135@N05/26803269896

Facebook:
<!-- Facebook Badge START --><a href="https://www.facebook.com/mtpsilva" title="Miguel Tom&#xe1;s Silva" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" target="_TOP">Miguel Tomás Silva</a><span style="font-family: &#039;lucida grande&#039;,tahoma,verdana,arial,sans-serif;font-size: 11px;line-height: 16px;font-variant: normal;font-style: normal;font-weight: normal;color: #555555;text-decoration: none;">&nbsp;|&nbsp;</span><a href="https://www.facebook.com/badges/" title="Make your own badge!" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" target="_TOP">Create Your Badge</a><br /><a href="https://www.facebook.com/mtpsilva" title="Miguel Tom&#xe1;s Silva" target="_TOP"><img class="img" src="https://badge.facebook.com/badge/100000283740142.3219.1600992697.png" style="border: 0px;" alt="" /></a><!-- Facebook Badge END -->

instagram:
<blockquote class="instagram-media" data-instgrm-version="6" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50.0% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAGFBMVEUiIiI9PT0eHh4gIB4hIBkcHBwcHBwcHBydr+JQAAAACHRSTlMABA4YHyQsM5jtaMwAAADfSURBVDjL7ZVBEgMhCAQBAf//42xcNbpAqakcM0ftUmFAAIBE81IqBJdS3lS6zs3bIpB9WED3YYXFPmHRfT8sgyrCP1x8uEUxLMzNWElFOYCV6mHWWwMzdPEKHlhLw7NWJqkHc4uIZphavDzA2JPzUDsBZziNae2S6owH8xPmX8G7zzgKEOPUoYHvGz1TBCxMkd3kwNVbU0gKHkx+iZILf77IofhrY1nYFnB/lQPb79drWOyJVa/DAvg9B/rLB4cC+Nqgdz/TvBbBnr6GBReqn/nRmDgaQEej7WhonozjF+Y2I/fZou/qAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/BCTR_qYxXfd/" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A photo posted by Miguel Tomas (@aeonpath)</a> on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2016-02-27T19:21:51+00:00">Feb 27, 2016 at 11:21am PST</time></p></div></blockquote> <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>

Vimeo:
<iframe src="https://player.vimeo.com/video/161193813?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/161193813">Garfunkel and Oates: Trying to be Special</a> from <a href="https://vimeo.com/rikiandkate">Riki + Kate</a> on <a href="https://vimeo.com">Vimeo</a>.</p>



*/
if (!isset($_POST['AddCode2Media']) or !isset($_POST['NumMedia'])):
	exit('No work to do!... need a latte?');
endif;

$input[0]=htmlspecialchars_decode($_POST['AddCode2Media']);
$numAdds=$_POST['NumMedia'];
if (!is_numeric($numAdds)):
	exit('Go work to do?... how many latte? '.$numAdds.' is enough?');	
endif;

for ($i = 0; $i < $numAdds; $i++):
	$input[]=htmlspecialchars_decode($_POST['MediaAdd'.$i]);
endfor;

$codeWrapper='<div class="stripped"><div class="stripped-left">{code}</div><div class="stripped-right"><a href="#MediaContent"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: AjxSimpleHtml(\'NewSaleDetails\', \'adicionar.server.php?del=media\');" alt="Apagar" /></a></div></div>';
$code='';
$newMedia=0;
$vars='';
for ($i = 0; $i < ($numAdds+1); $i++):
	if(strpos($input[$i], 'flickr.com')!==false):
		$tmp=explode("/", $input[$i]);
		foreach ($tmp as $key => $value):
			if (strpos($value, "@")!==false):
				$photocode=$value;
				break;
			endif;	
		endforeach;
		$FlickrCode='<iframe width="560" height="315" src="https://www.flickr.com/photos/'.$photocode.'/player"frameborder="0" allowfullscreen></iframe>';
		$FlickrCode=str_replace("{code}", $FlickrCode ,$codeWrapper);
		$code.=$FlickrCode.'<input type="hidden" id="MediaAdd'.$newMedia.'" value="'.htmlentities(htmlspecialchars($FlickrCode)).'" />';
		$vars.=",'MediaAdd".$newMedia."'";
		$newMedia++;
	elseif(strpos($input[$i], 'facebook.com')):
		$code.=str_replace("{code}", $input[$i] ,$codeWrapper).'<input type="hidden" id="MediaAdd'.$newMedia.'" value="'.htmlentities(htmlspecialchars($input[$i])).'" />';
		$vars.=",'MediaAdd".$newMedia."'";
		$newMedia++;
	elseif(strpos($input[$i], 'instagram.com')):
		$code.=str_replace("{code}", $input[$i] ,$codeWrapper).'<input type="hidden" id="MediaAdd'.$newMedia.'" value="'.htmlentities(htmlspecialchars($input[$i])).'" />';
		$vars.=",'MediaAdd".$newMedia."'";
		$newMedia++;
	elseif(strpos($input[$i], 'youtube.com')):
		$code.=str_replace("{code}", $input[$i] ,$codeWrapper).'<input type="hidden" id="MediaAdd'.$newMedia.'" value="'.htmlentities(htmlspecialchars($input[$i])).'" />';
		$vars.=",'MediaAdd".$newMedia."'";
		$newMedia++;
	endif;
endfor;
$code.='<input type="hidden" name="NumMedia" id="NumMedia" value="'.$newMedia.'" /><script> document.getElementById(\'AddCode2Media\').value=""; var sendVars=[\'AddCode2Media\', \'NumMedia\''.$vars.'];</script>';
?>


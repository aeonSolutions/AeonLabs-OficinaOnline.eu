<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class ValidationFilesDB{
	static $files= array();
	static $field= array();


	public static function LoadValidationFiles(){
		$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
		self::$files=glob($server['root']['path'].'temporary/*.wait.db', GLOB_NOSORT);
		for ($i = 0; $i < count(self::$files); $i++):
			include(self::$files[$i]);
			self::$field['tokenID'][]=$waiting['tokenID'];
			self::$field['contactID'][]=$waiting['contactID'];
			self::$field['contacts'][]=$waiting['contacts'];
			self::$field['response'][]=$waiting['response'];
			self::$field['response2'][]=$waiting['response2'];
			self::$field['email'][]=$waiting['email'];
		endfor;
	}
	
	public static function CheckOnValidationFiles($field, $what){
		if ($what=='' or $field==''):
			return false;
		elseif ( is_array(self::$field[$field])):
			if(in_array($what, self::$field[$field])):
				return array_search($what, self::$field[$field] );
			else:
				return false;
			endif;	
		else:
			return false;
		endif;
	}

	public static function ListDetails($pos){
		$tmp=explode(chr(13), self::$field['contacts'][$pos]);
		for ($i = 0; $i < count($tmp); $i++):
			$tmp2=explode(":", $tmp[$i]);
			$details[$tmp2[0]]=$tmp2[1];
		endfor;
		return $details;
	}

};

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function CleanValidationFiles(){
	$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
	$files=glob($server['root']['path'].'temporary/*.wait.db', GLOB_BRACE);
	for ($i = 0; $i < count($files); $i++):
		$filemtime=filemtime ($files[$i]);
        if (time()-$filemtime>= (7*24*60*60) ): //older than 7 days
           unlink($files[$i]);
        endif;
	endfor;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checkSession(){
        if($_SESSION['OBSOLETE'] && ($_SESSION['EXPIRES'] < time()))
            return 'Attempt to use expired session.';

        if(!is_numeric($_SESSION['user_id']))
            return 'No session started.';

        if($_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'])
           return 'IP Address mixmatch (possible session hijacking attempt).';

        if($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT'])
            return 'Useragent mixmatch (possible session hijacking attempt).';

       // if(!$this->loadUser($_SESSION['user_id']))
         //   throw new Exception('Attempted to log in user that does not exist with ID: ' . $_SESSION['user_id']);

		if (!preg_match("/^[0-9a-z]*$/i", session_id()))
    		return "Your session id is messed up, you might not be able to use some features on this site.";
    
       // if(!$_SESSION['OBSOLETE'] && mt_rand(1, 100) == 1):
       //     $this->regenerateSession();
       // endif;

        return true;

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function GenerateRealmKey($size=null){

$character_array = array_merge(range("a", "z"), range(0, 9), range("A", "Z"));
$string = "";

$RealmIDLen= ($size !=null)? $size : 256;

    for($i = 0; $i < $RealmIDLen; $i++):
        $string .= $character_array[rand(0, (count($character_array) - 1))];
    endfor;
return $string;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function public_encrypt($plaintext){
        $fp=fopen("./mykey.pub","r");
        $pub_key=fread($fp,8192);
        fclose($fp);
        openssl_get_publickey($pub_key);
        openssl_public_encrypt($plaintext,$crypttext, $pub_key );
        return(base64_encode($crypttext));
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function private_decrypt($encryptedext){
        $fp=fopen("./mykey.pem","r");
        $priv_key=fread($fp,8192);
        fclose($fp);
        $private_key = openssl_get_privatekey($priv_key);
        openssl_private_decrypt(base64_decode($encryptedext), $decrypted, $private_key);
        return $decrypted;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
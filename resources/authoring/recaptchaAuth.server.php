<?php
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');

if (isset($_POST["g-recaptcha-response"])):
	require_once "recaptchalib.php";
	// Register API keys at https://www.google.com/recaptcha/admin
	$siteKey = "6LdYhR8TAAAAAJNdz8ocmgdPh3C1maHmNBgFSAwZ";
	$secret = "6LdYhR8TAAAAANJXRexncGJCrXHPOOlZBsJmm3o7";
	// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
	$lang = "pt";
	// The response from reCAPTCHA
	$resp = null;
	// The error code from reCAPTCHA, if any
	$error = null;
	$reCaptcha = new ReCaptcha($secret);
	// Was there a reCAPTCHA response?
    $resp = $reCaptcha->verifyResponse('',$_POST["g-recaptcha-response"]);
	if ($resp != null && $resp->success):
		$failCaptcha=false;
	else:
		$failCaptacha=true;
	endif;
else:
	$failCaptacha=true; // verify is is sset on $_POST VARS
	
endif;
?>
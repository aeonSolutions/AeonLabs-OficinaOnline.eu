
function SendAuth() {		
	document.getElementById('PageMask').style.visibility='visible';

	var params={params};
	var DestinationID ='{DestinationID}';
	var data2send = PrepareForm2send(params);

	var username = '{contactID}';
	var token = document.getElementById('TokenID').value;

	var A1 = md5(username+'{realm}'+token); 
	var A2 = md5('{randomString}' + '{pid}'); 
				
	var code = md5(A1+'{opaque}'+'{serverTime}'+A2);			
	code = '&response='+ encodeURIComponent(code) + '&response2=' + encodeURIComponent('{nonce}')+ '&pid='+encodeURIComponent('{pid}') + '&CID='+encodeURIComponent(username);

	document.getElementById('PageMask').style.visibility='visible';
	MakeRequest('{requestURI}?pid={pid}', data2send + code, DestinationID);

}

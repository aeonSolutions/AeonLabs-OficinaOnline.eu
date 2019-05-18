
function SendAuth() {		

	var params={params};
	var DestinationID ='{DestinationID}';
	var data2send = PrepareForm2send(params);

	var username = document.getElementById('ContactID').value;
	var token = document.getElementById('TokenID').value;

	var A1 = md5(username+'{realm}'+token); 
	var A2 = md5('{randomString}' + '{pid}'); 
				
	var code = md5(A1+'{opaque}{serverTime}'+A2);			
	code = '&response='+ encodeURIComponent(code) + '&response2=' + encodeURIComponent('{nonce}')+ '&pid='+encodeURIComponent('{pid}') + '&{type}='+encodeURIComponent(username);
	
	data2send= data2send + code;
	
	document.getElementById('PageMask').style.visibility='visible';
	MakeRequest('{requestURI}?pid={pid}', data2send , DestinationID);

}

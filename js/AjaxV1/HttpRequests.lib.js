/* last update: 18-05-2016 */
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/*Global variables*/
var SID;

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function SessionID(sess) {
	if (sess != null) {
		SID=sess;
	}else {
		if (SID==null || SID=='') {
			return false;
		} else {
			return SID;			
		}
	}
};
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function SessionIDValidation(url){
	var response = (url.indexOf("?") != -1) ? "&" : "?";
	//ToDo: encode string to send server 
	response+='s=' + encodeURIComponent(response);
	return response;
};
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/* common method to get XMLHttp request object */
function getXMLHttpRequest(){
	var req;
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	return ajaxRequest;
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function getNoCacheValue(url){
	var d = new Date();
	var appendstring = (url.indexOf("?") != -1) ? "&" : "?";
	var nocachevalue = appendstring + "no-cache=" + d.getTime();
	return nocachevalue;
}


/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function PrepareForm2send(params) {
	if (params != null || params !='') {
		var data2send='';
		var value='';
		for (var i = 0; i < params.length; i++) {
		  	if (document.getElementById(params[i])) {
				data2send += (i > 0 ? "&" : "");
				if (document.getElementById(params[i]).type == 'checkbox' || document.getElementById(params[i]).type == 'radio'){
				if(document.getElementById(params[i]).checked==false){
					value=0;
				}else {
					value=1;
				}
				}else { // other input fields
					value = document.getElementById(params[i]).value;
				}
			data2send += params[i] + '=' + encodeURIComponent(value);
		  	}
		} //endfor
		return data2send;
	}else {
		return '';
	}
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function PrepareStr2send(url) {
	var data2send ='';
	if (url.indexOf("?") != -1) {
		var works= url.split("?");
		if (works[1] != null) {
			var vars= works[1].split("&");
		}
	} else if (url.indexOf("&") != -1) {
		var vars= url.split("&");
	}
	if (vars != null) {
		for (var i = 0; i < vars.length; i++) {
			data2send += (i > 0 ? "&" : "");
			var tmp = vars[i].split("=");
			data2send = data2send + tmp[1]+'='+ encodeURIComponent(tmp[2]);
		}	//endfor	
	}			

	return data2send;
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function invokeScript(divid){
	var DivIdObj = document.getElementById(divid);
	var scriptObj = DivIdObj.getElementsByTagName("script");
	for(var i=0; i< scriptObj.length; i++){ // number of script tags found
		var scriptText = scriptObj[i].text;
		var scriptFile = scriptObj[i].src;		
		var scriptTag = document.createElement("script");

		if ((scriptFile != null) && (scriptFile != "")){
			scriptTag.src = scriptFile;
		}
		scriptTag.text = scriptText;
		if (!document.getElementsByTagName("head")[0]) {
			document.createElement("head").appendChild(scriptTag);
		} else {
			document.getElementsByTagName("head")[0].appendChild(scriptTag);
		}
	}
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function FindScript(Str){ 
	if (Str.indexOf("script")!=-1) {
		return true;
	}else {
		return false;
	}
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//<b>Warning</b> 	on line 	<br />

function Digest(code){
	if (code.indexOf("<b>Warning</b>")!=-1) {

		var warning= '';
		var msg='';
		var start = (code.indexOf("<b>Warning</b>", 0)!=-1) ? code.substring(0, code.indexOf("<b>Warning</b>", 0)) : '';
		var i=0;
		while (code.indexOf("<b>Warning</b>", 0)!=-1) {
			
			warning = code.substring(code.indexOf("<b>Warning</b>", 0)+15, code.indexOf("<br />", code.indexOf("on line", code.indexOf("<b>Warning</b>", 0)+15)+9));
			code = code.substring(code.indexOf("<br />", code.indexOf(" on line", 0) ), code.length);

			msg= msg + String.fromCharCode(13) + String.fromCharCode(13) + warning.replace(" - ", String.fromCharCode(13));
			msg = msg.replace("in <b>", String.fromCharCode(13));
			i++;
		}
		code= start + code.substring(7, code.length);
		
		window.alert('Warnings('+i+'):'+msg);
	}
	return code;
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function Where2Land(code){ // result[0] DestinationID result[1] remaining code to load
	if (code.indexOf("container:")!=-1) {
		var result = new Array();
		result[0]= code.substring(code.indexOf('container:'), code.indexOf(String.fromCharCode(13), code.indexOf( 'container:')));
		result[1]= code.substring(code.indexOf(String.fromCharCode(13), code.indexOf( 'container:' )), code.length);
		var tmp= result[0].split(" ");
		result[0]=tmp[1];
		return result;
	} else {
		return false;
	}
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function ClickedID() {
	var buttons = document.getElementsByTagName("button");
	var buttonsCount = buttons.length;
	for (var i = 0; i <= buttonsCount; i += 1) {
	    buttons[i].onclick = function(e) {
	        alert(this.id);
	    };
	}
}
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function CommBusy() {
    var z, xml = null;
    var result='';
    
    xml = new XMLHttpRequest();
    xml.open("get", '/?pid=uLMmULgUzFE8KU8ocrRgwFW6v9LA1j', false);

    try {
        xml.send(null);
    } catch(z) {
        result="Network Failure";
        return result;
    }

    if ((xml.status >= 200 && xml.status <= 300) || xml.status == 304) {
        var hi = xml.responseText; //Server reached
        return false;
    } else if(xml.status == 503 || xml.status == 504 || xml.status == 408){
		result="TimeOut or temporarily unavailable";
	} else if(xml.status == 429 ){
		result="Server is busy";
    } else {
		result="No Internet Connection("+ xml.status + ")";
		return result;
    }
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function CommServer(pid, params, DestinationId, RetryCount) { //accepts "GET:" or "POST:" on pid var to choose send format 

	document.getElementById('PageMask').style.visibility='visible';
	setTimeout(lockScreen('visible'), 100);	
	document.getElementById('Dialogs').innerHTML="Sendind Data... one moment please!";
	
	if (document.readyState) {
		AjxPrepareData(pid, params, DestinationId);
	} else if (Boolean(RetryCount)){
		if (RetryCount<10) {
			setTimeout(CommServer(pid, params, DestinationId, RetryCount +1), 100);			
		} else {
			var Status = CommBusy();
			if ( Status == false) { //server is free for a new request
				AjxPrepareData(pid, params, DestinationId);
			}else { 
				if (Status=='Network Failure') {
					//display retry on 20 seconds to user
					DlgBox('Network Failure!', 'wait');
					CommServer(url, params, DestinationId);
				} else if (Status=='No Internet Connection') {
					DlgBox('No Internet Connection!!!', 'stop');
				} else { //no errors except busy
					window.alert('Server Busy:'+ Status + 'retrying on 10 sec');		
					//retry on 10 seconds
					setTimeout( AjxPrepareData(pid, params, DestinationId) , 10000);			
				}
			} // endif 1st status
		} //if retry count
	} // if readyState

	lockScreen('hidden');

	function lockScreen(state) {
		document.getElementById('PageMask').style.visibility=state;
		
	}
};
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function AjxPrepareData(pid, params, DestinationId){ 

	var url= '/?pid=' + pid;
	var data2send='';	
	
	if (Boolean(params)) {
		if (params instanceof Array ) {
			data2send= PrepareForm2send(params);			
		} else { // files to upload		
			data2send= params;
		}
	}else {
		data2send= PrepareStr2send(url);
	}
	
	url = url + getNoCacheValue(url);
	
	if (SessionID()!=false) {
		url+=SessionIDValidation(url);
	}
		
	MakeRequest(url, data2send, DestinationId);
};
//////////////////////////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function MakeRequest(url, data2send, DestinationId) {
	document.getElementById('PageMask').style.visibility='visible';
	document.getElementById('Dialogs').innerHTML="&nbspSending Data..one moment please!";
	//window.alert('DATA2SEND:'+String.fromCharCode(13)+data2send);
		
	var ajaxRequest = getXMLHttpRequest();
	ajaxRequest.onreadystatechange = function(){
										if (ajaxRequest.readyState == 4) {									
											if ((ajaxRequest.status >= 200 && ajaxRequest.status <= 300) || ajaxRequest.status == 304) {
												if (ajaxRequest.status == 200) {
													var code = Digest(ajaxRequest.responseText);
													
													window.alert('DataArrived:'+String.fromCharCode(13)+ code);
													
													var OutputResult= Where2Land(code);// result[0] DestinationID result[1] remaining code to load
										
													DestinationId = (OutputResult===false) ? DestinationId : OutputResult[0];
													code = (OutputResult===false) ? code : OutputResult[1];
													document.getElementById(DestinationId).innerHTML  =  code;
													if (document.getElementById(DestinationId+'Wait')) {
														document.getElementById(DestinationId+'Wait').innerHTML = '<i class="fa fa-check-circle-o status-check fade-in"></i>';
													}
													
													if ( FindScript(code) ) {
														invokeScript(DestinationId); 												
													}
												} else if  (ajaxRequest.status == 401) {
													document.getElementById(DestinationId).innerHTML  =  DlgBox(msg);
												}else {
													if (document.getElementById(DestinationId+'Wait')) {
														document.getElementById(DestinationId+'Wait').innerHTML = '<i class="fa fa-exclamation-triangle status-error fade-in"></i>';
													}
												}											
											
											} else if(ajaxRequest.status == 503 || ajaxRequest.status == 504 || ajaxRequest.status == 408){
												window.alert("Conenection TimeOut or Server temporarily unavailable");
											} else if(ajaxRequest.status == 429 ){
												window.alert("Server is busy");
											} else { // user aborted or reloaded page
												ajaxRequest.abort();
												window.alert("Aborted comm with server");
											}
											document.getElementById('PageMask').style.visibility='hidden';
										} //endif readystate=4
									};
	

	SendRequest(ajaxRequest, url, data2send);

};
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function SendRequest(ajaxRequest, url, data2send){

	var method = (data2send != null) ? 'POST' : 'GET';
	var content2send = (data2send != null) ? data2send : '';
	
	ajaxRequest.open(method, url, true);
	if (method=='POST') {
		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	}
	ajaxRequest.send(data2send); //POST VARS ONLY
	try {
	    ajaxRequest.send(content2send);
	} catch(z) {
		// ToDo:
		var test='';
	}
}
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function SendBinaryRequest(ajaxRequest, url, data2send){

	ajaxRequest.setRequestHeader("Content-type", "application/octet-stream");	

	
	
	
	
	ajaxRequest.send(data2send); //POST VARS ONLY
	try {
	    ajaxRequest.send(content2send);
	} catch(z) {
		// ToDo:
		var test='';
	}
}


/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function SendFile(pid, fileSelect, DestinationID) {
	// Get the selected files from the input.
	var files = document.getElementById(fileSelect).files;
	// Create a new FormData object.
	var formData = new FormData();
	// create request header
	var header = 
	

	// Loop through each of selected files.
	for (var i = 0; i < files.length; i++) {
	  	var file = files[i];
	 	// Check the file type.
		if (!file.type.match('image.*')) {
	    	continue;
		}
	 	// Add the file to the request.
		formData.append('files', file, file.name);
	}



	CommServer(pid, formData, DestinationID);
};

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

  send : function() {
        var boundary = this.generateBoundary();
        var xhr      = new XMLHttpRequest;

        xhr.open("POST", this.form.action, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                alert(xhr.responseText);
            }
        };
        var contentType = "multipart/form-data; boundary=" + boundary;
        xhr.setRequestHeader("Content-Type", contentType);

        for (var header in this.headers) {
            xhr.setRequestHeader(header, headers[header]);
        }

        // finally send the request as binary data
        xhr.sendAsBinary(this.buildMessage(this.elements, boundary));
    }
};









//ToDo function
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function checkSend(pid, params, DestinationId) { 
	if (document.all.com.readyState) {
		CommServer(pid, params, DestinationId);
	}else{
 		setTimeout('checkSend(\'' + args + '\')', 100); 
	}
} 

function fAsynchronousGetAbort() {
	var oXMLHttpRequest	= new XMLHttpRequest;
	oXMLHttpRequest.open("GET", "server.php", true);
	oXMLHttpRequest.onreadystatechange	= function() {
		if (this.readyState == XMLHttpRequest.DONE) {
			// my code
		}
	}
	oXMLHttpRequest.send(null);
	oXMLHttpRequest.abort();
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function BackgroundRequest() {
// add to Queue 
// with lower priority

if (typeof yourFunctionName == 'function'){
 yourFunctionName(); 
}

xhr.upload.onprogress = function(e) { ... };
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function ProcessRequests(){

}
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

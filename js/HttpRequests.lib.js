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
function getNoCacheValue(url){
	var d = new Date();
	var appendstring = (url.indexOf("?") != -1) ? "&" : "?";
	var nocachevalue = appendstring + "no-cache=" + d.getTime();
	return nocachevalue;
};

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function Boundary() {
	var d = new Date();
	return "---------------------------" + d.getTime();
};

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
};

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
};

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
};

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
};

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function Where2Land(code){ // result[0] DestinationID result[1] remaining code to load
	
	if (code.indexOf("container:")!=-1) {
		var result = new Array();
		result[0]= code.substring(code.indexOf('container:'), code.indexOf(String.fromCharCode(13), code.indexOf( 'container:')));
		result[1]= code.substring(code.indexOf(String.fromCharCode(13), code.indexOf( 'container:' )), code.length);
		var tmp=result[0].split(":");
		result[0]=tmp[1];
		result[0]=result[0].replace(" ", "");
		return result;
	} else {
		return false;
	}
};


/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function $CommBusy() {
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
};

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function CommServer(pid, params, DestinationId, RetryCount) { //accepts "GET:" or "POST:" on pid var to choose send format 

	document.getElementById('PageMask').style.visibility='visible';
	document.getElementById('Dialogs').innerHTML="Sendind Data... one moment please!";
	
	if (document.readyState) {
		$AjxPrepareData(pid, params, DestinationId);
	} else if (Boolean(RetryCount)){
		if (RetryCount<10) {
			setTimeout(CommServer(pid, params, DestinationId, RetryCount +1), 100);			
		} else {
			var Status = $CommBusy();
			if ( Status == false) { //server is free for a new request
				$AjxPrepareData(pid, params, DestinationId);
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
					setTimeout( $AjxPrepareData(pid, params, DestinationId) , 10000);			
				}
			} // endif 1st status
		} //if retry count
	} // if readyState
};
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function $AjxPrepareData(pid, params, DestinationId){ 

	var url= '/?pid=' + pid;
	var data2send='';	
	
	if (Boolean(params)) {
		if (typeof params === 'object'){	//for files 		
			data2send=params;
		}else if (params instanceof Array ) {
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
	//window.alert('DATA2SEND:'+String.fromCharCode(13)+data2send);
	try{
		// Opera 8.0+, Firefox, Safari
		xhr = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
	// progress bar
	if (xhr.upload) {
		document.getElementById('Dialogs').innerHTML='<div id="progress"></div>';
		var o = document.getElementById('progress');
		var progress = o.appendChild(document.createElement("p"));
		progress.appendChild(document.createTextNode("upload " + data2send.name));
		xhr.upload.addEventListener("progress", function(e) {
														var pc = parseInt(100 - (e.loaded / e.total * 100));
														progress.style.backgroundPosition = pc + "% 0";
													}
													, false);
	}
	
	xhr.onreadystatechange = function () {
										if (xhr.readyState == 4) {									
											if ((xhr.status >= 200 && xhr.status <= 300) || xhr.status == 304) {
												if (xhr.status == 200) {
													document.getElementById('Dialogs').innerHTML='';
													var code = Digest(xhr.responseText);
													
													window.alert('DataArrived:'+String.fromCharCode(13)+ code);
													
													var OutputResult= Where2Land(code);// result[0] DestinationID result[1] remaining code to load
										
													DestinationId = (OutputResult===false) ? DestinationId : OutputResult[0];
													
													code = (OutputResult===false) ? code : OutputResult[1];
													
													document.getElementById(DestinationId).innerHTML  =  code;
													if (document.getElementById(DestinationId+'Wait')) {
														document.getElementById(DestinationId+'Wait').innerHTML = '<i class="fa fa-check-circle-o status-check fade-in"></i>';
													}
													if ( code.indexOf("script") !=-1 ) {
														invokeScript(DestinationId); 												
													}
												}else {
													if (document.getElementById(DestinationId+'Wait')) {
														document.getElementById(DestinationId+'Wait').innerHTML = '<i class="fa fa-exclamation-triangle status-error fade-in"></i>';
													} else {
														document.getElementById(DestinationId).innerHTML  = $DlgBox('Error Communicating with server:'+xhr.status);
													}
												}											
											
											} else if(xhr.status == 503 || xhr.status == 504 || xhr.status == 408){
												window.alert("Conenection TimeOut or Server temporarily unavailable");
											} else if(xhr.status == 429 ){
												window.alert("Server is busy");
											} else { // user aborted or reloaded page
												xhr.abort();
												window.alert("Aborted comm with server");
											}
										} //endif readystate=4
										document.getElementById('PageMask').style.visibility='hidden';
										

							}
	
// Send Request
	var method = (data2send != null) ? 'POST' : 'GET';	
	xhr.open(method, url, true);


	if (typeof data2send === 'object'){	//for files 
		xhr.setRequestHeader("X_FILENAME", data2send.name);
	}else if (method=='POST') { //send vars via POST
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	}
	
	try {
	    xhr.send(data2send);
	} catch(z) {
		// ToDo:
		window.alert('error sending data to server');
	}
};

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function LoadElements(FormID){
		var elements = document.getElementById(FormID);
		
        var fields = [];

        // gather INPUT elements
        var inputs = elements.getElementsByTagName("INPUT");
        for (i=0; i< inputs.length; i++) {
            fields.push(inputs[i]);
        }

        // gather SELECT elements
        var selects = this.form.getElementsByTagName("SELECT");
        for (i=0; i< selects.length; i++) {
            fields.push(selects[i]);
        }
		// ToDo: Radio and checkboxes
		
		
        return fields;


};
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

//ToDo functions
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function ClickedID() {
	var buttons = document.getElementsByTagName("button");
	var buttonsCount = buttons.length;
	for (var i = 0; i <= buttonsCount; i += 1) {
	    buttons[i].onclick = function(e) {
	        alert(this.id);
	    };
	}
};
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

xhr.upload.onprogress = function(e) { 
							var t='';
						
						};
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function ProcessRequests(){

var file;
if (file !== null) {
  if (accept.binary.indexOf(file.mediaType) > -1) {
    // file is a binary, which we accept
    var data = file.getAsBinary();
  } else if (accept.text.indexOf(file.mediaType) > -1) {
    // file is of type text, which we accept
    var data = file.getAsText();
    // modify data with string methods
  }
}


}
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// send multi files 
function SendFileOld(pid, fileSelect, DestinationID) {
    var CRLF  = "\r\n";
	var FilesId = document.getElementById(fileSelect);	
	var part = "--" + Boundary() + CRLF + part;
	var NameOfVar='files';
	
	// object for allowed media types
	var accept = {
	  binary : ["image/png", "image/jpeg"],
	  text   : ["text/plain", "text/css", "application/xml", "text/html"]
	};
	
	
	// Loop through each of selected files.
	for (var i = 0; i < FilesId.files.length; i++) {
	  	var file = FilesId.files[i];
	  	window.alert(file.name);

        /*
         * Content-Disposition header contains name of the field used
         * to upload the file and also the name of the file as it was
         * on the user's computer.
         */
        part += 'Content-Disposition: form-data; ';
        part += 'name="' + NameOfVar + '"; ';
        part += 'filename="'+ file.name + '"' + CRLF;

        /*
         * Content-Type header contains the mime-type of the file to
         * send. Although we could build a map of mime-types that match
         * certain file extensions, we'll take the easy approach and
         * send a general binary header: application/octet-stream.
         */
        part += "Content-Type: application/octet-stream" + CRLF + CRLF;

        /*
         * File contents read as binary data, obviously
         */
        part += file.getAsBinary() + CRLF;
        
        part += "--" + Boundary() + CRLF;
	}	
	
	var data2send = part;
	CommServer(pid, data2send, DestinationID);

};
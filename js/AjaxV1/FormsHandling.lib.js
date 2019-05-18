/////////////////////////////////////////////////////////////Remove Selected option from list \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function RemoveListItem(InputId) {
	if (document.getElementById(InputId)) {
		var x = document.getElementById(InputId);
		x.remove(x.selectedIndex);
	}
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function AjxSimpleInput(InputId, url, method, params){
	
	url = url + getNoCacheValue(url);
	
	var ajaxRequest = getXMLHttpRequest();
	ajaxRequest.onreadystatechange = function(){
										if (ajaxRequest.readyState == 4) {
											if (ajaxRequest.status == 200) {
												document.getElementById(InputId).value  =  ajaxRequest.responseText;
											}else {
												document.getElementById(InputId).value  =  ajaxRequest.responseText;
											}
										}
									};
	MakeResponse(ajaxRequest, method, url, params);
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function AjxInput(InputId, url,  method, params){
	
	url = url + getNoCacheValue(url);
	var wait = InputId + '-wait';


	var ajaxRequest = getXMLHttpRequest();
	document.getElementById(InputId).disabled=true;
	document.getElementById(wait).innerHTML = '<i class="fa fa-clock-o"></i>';
	var data= encodeURIComponent(document.getElementById(InputId).value);
	var params= InputId + "=" + data;
	
	ajaxRequest.onreadystatechange = function(){
										if (ajaxRequest.readyState == 4) {
											if (ajaxRequest.status == 200) {
												document.getElementById(InputId).value = ajaxRequest.responseText;
												document.getElementById(wait).innerHTML = '<i class="fa fa-check-circle-o status-check fade-in"></i>';
											}else {
												document.getElementById(wait).innerHTML = '<i class="fa fa-exclamation-triangle status-error fade-in"></i>';
											}
											document.getElementById(InputId).style.pointerEvents = "auto";
											document.getElementById(InputId).disabled=false;
										}
									};
	MakeResponse(ajaxRequest,"post", url, params);
}
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function AjxCheckBox(InputId, url,  method, params){
	
	url = url + getNoCacheValue(url);
	var wait = InputId + '-wait';

	var ajaxRequest = getXMLHttpRequest();
	document.getElementById(InputId).disabled=true;
	document.getElementById(wait).innerHTML = '<i class="fa fa-clock-o"></i>';
	//var data= encodeURIComponent(document.getElementById(InputId).value);
	var data = document.getElementById(InputId).checked;
	data = data ? 1 : 0;
	var params = InputId + "=" + data;
	ajaxRequest.onreadystatechange = function(){
										if (ajaxRequest.readyState == 4) {
											if (ajaxRequest.status == 200) {
												var response = ajaxRequest.responseText;
												var check_script= FindScript(response);
												//check if form element is a checkbox or radio button
												if (document.getElementById(InputId).type=='checkbox' || document.getElementById(InputId).type=='radio') {
													if (response == 'true' || response == true || response == 'selected' || response==1) {
														document.getElementById(InputId).checked= true;
													} else {
														document.getElementById(InputId).checked= false;													
													}													
												}
												if (check_script===true) { //check for a script on the response 
													var content = check_script[0];	//scipt code
												} else {
													var content ='';
												}
												document.getElementById(wait).innerHTML = content + '<i class="fa fa-check-circle-o status-check fade-in"></i>';
												invokeScript(wait); 
											}else {
												document.getElementById(wait).innerHTML = '<i class="fa fa-exclamation-triangle status-error fade-in"></i>';
											}
											document.getElementById(InputId).style.pointerEvents = "auto";
											document.getElementById(InputId).disabled=false;
										
										}
									};
	MakeResponse(ajaxRequest,"post", url, params);
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function AjxDropDown(InputId, url,  method, params){
	
	url = url + getNoCacheValue(url);
	var wait = InputId + '-wait';

	var ajaxRequest = getXMLHttpRequest();
	document.getElementById(InputId).disabled=true;
	document.getElementById(wait).innerHTML = '<i class="fa fa-clock-o"></i>';

	var selList = document.getElementById(InputId);
	var mySelectedIndex = selList.options.selectedIndex;
	var mySelectedText = selList.options[selList.options.selectedIndex].text;
	var mySelectedValue = selList.options[selList.options.selectedIndex].value;

	var params = InputId + "=" + mySelectedValue;
	
	ajaxRequest.onreadystatechange = function(){
										if (ajaxRequest.readyState == 4) {
											if (ajaxRequest.status == 200) {
												var response = ajaxRequest.responseText;
												
												for (var i = 0; i < selList.options.length; i++) {
												 var tmpOptionText = selList.options[i].text;
												 var tmpOptionValue = selList.options[i].value;
												 
												 if(tmpOptionText == response ) selList.selectedIndex = i;
												}

												document.getElementById(wait).innerHTML = '<i class="fa fa-check-circle-o status-check fade-in"></i>';
											}else {
												document.getElementById(wait).innerHTML = '<i class="fa fa-exclamation-triangle status-error fade-in"></i>';
											}
											document.getElementById(InputId).style.pointerEvents = "auto";
											document.getElementById(InputId).disabled=false;
										
										}
									};
	MakeResponse(ajaxRequest,"post", url, params);
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function AjxForm(InputId, url, params){
	
	url = url + getNoCacheValue(url);
	var wait = InputId + '-wait';

	var ajaxRequest = getXMLHttpRequest();
	document.getElementById(InputId).disabled=true;
	document.getElementById(wait).innerHTML = '<i class="fa fa-clock-o"></i>';
	
	var data2send=PrepareParameters(params);
	ajaxRequest.onreadystatechange = function(){
										if (ajaxRequest.readyState == 4) {
											if (ajaxRequest.status == 200) {
												var response = ajaxRequest.responseText;
												var check_script= FindScript(response);
												if (check_script===false) {
													document.getElementById(InputId).innerHTML  =  response;	//sciptless code											
													invokeScript(InputId); 
												}else { // no code only update radio or checkbox
													if (response == 'selected') {
														document.getElementById(InputId).checked= true;
													} else {
														document.getElementById(InputId).checked= false;													
													}	
												}
												document.getElementById(wait).innerHTML = '<i class="fa fa-check-circle-o status-check fade-in"></i>';
											}else {
												document.getElementById(wait).innerHTML = '<i class="fa fa-exclamation-triangle status-error fade-in"></i>';
											}
											document.getElementById(InputId).style.pointerEvents = "auto";
											document.getElementById(InputId).disabled=false;
										
										}
									};
	MakeResponse(ajaxRequest,"post", url, data2send);
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

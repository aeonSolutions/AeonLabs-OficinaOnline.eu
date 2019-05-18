/* last update: 16-05-2016 */


/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function DlgBox(msg) {
	document.getElementById('PageMask').style.visibility='visible';
	document.getElementById('Dialogs').style.visibility='visible';
	document.getElementById('Dialogs').innerHTML=msg;
	
	setTimeout(CloseDlgBox(), 20000);
};

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function CloseDlgBox() {
	document.getElementById('PageMask').style.visibility='hidden';
	document.getElementById('Dialogs').innerHTML="&nbsp";
};


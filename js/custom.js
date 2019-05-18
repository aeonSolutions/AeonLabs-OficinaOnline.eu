
//////////////////////////////////////////////////////////////////////////////////////////
function HtmlTogglePanel(checkbox) {
	document.getElementById(checkbox+'-contents').classList.toggle('closed');
	var btn= document.getElementById(checkbox);
	if (btn.checked==true) {
		btn.checked=false;
	}else {
		btn.checked=true;
	}			
};

//////////////////////////////////////////////////////////////////////////////////////////
function CleanAddSale() {
	document.getElementById('UserInputTotal').value=' ';
	document.getElementById('NewSaleUserInput').value=' ';
	document.getElementById('NewSaleDetails').innerHTML='<div style="margin: 0 auto; width: 100%;text-align:center; padding-top: 70px;"><p>Comece por introduzir algumas caraterísticas...</p><img src="../images/autoDesign.png" /><p>como por exemplo a marca e o modelo do automóvel...</p></div><input type="hidden" id="UserInputTotal"name="UserInputTotal" value="" />';

};
//////////////////////////////////////////////////////////////////////////////////////////

function CleanAddMedia(){
	document.getElementById('AddCode2Media').value=' ';
	document.getElementById('MediaDetails').innerHTML='<div style="margin: 0 auto; width: 100%;text-align:center; padding-top: 70px;"><p>Abra a Página Web onde tem o seu photo album</p><img src="../images/supercars_gallery.jpg" /><p>e cole no formulário o código que lhe é disponibilizado...</p></div><input type="hidden" name="NumMedia" id="NumMedia" value="0" /><script> var sendVars=[\'AddCode2Media\', \'NumMedia\'];</script>';

};

//////////////////////////////////////////////////////////////////////////////////////////

function CleanAddPrice() {
	document.getElementById('VendaCondicoes').value=' ';
	document.getElementById('VendaPreco').value=' ';
	document.getElementById('VendaDuracao').value=' ';
	document.getElementById('VendaReserva').value=' ';
	document.getElementById('VendaDesconto').value=' ';
	document.getElementById('VendaDescontoDuracao').value=' ';
	document.getElementById('VendaDescontoInicio').value=' ';

}
/*

*/


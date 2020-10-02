function download_excel(){
	window.location.href = "export_xls/export.php";
}

function import_button(){
	if((document.getElementById("colunas").value != "") && (document.getElementById("nome_banco").value != "")){
		document.getElementById("form-excel").action = "action/cadastrar.php";
		document.getElementById("form-excel").submit();
	}else{
		alert('Favor Preencher Todos os Campos');
	}
}

function format_button(){
	document.getElementById("form-excel").action = "export_xls/excel_formato.php";
	document.getElementById("form-excel").submit();
}
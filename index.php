<html>
	<head>
 		<title>Import Excel to Mysql using PHPExcel in PHP</title>
 		<?php require_once('include/header.php'); ?>
	</head>
	<body>
		<div class="container box">
			<h3 align="center">Importar Excel para o MYSQL</h3><br />
			<form id = "form-excel" method="post" enctype="multipart/form-data" action="#">
				<div class="row">
					<div class = "col-lg-6">
						<label> Numero de Colunas</label>
						<input type="number" name="colunas" id="colunas" />
					</div>
					<div class = "col-lg-6">
						<label> Nome da Tabela   </label>
						<input type="text" name="nome_banco" id="nome_banco" />
					</div>
				</div>
				<div class="row">
					<div class = "col-lg-6">
						<label>Select Excel File</label>
						<input type="file" name="excel"  required />
					</div>
				</div>
				<br />
				<input type="button" name="import" class="btn btn-success" value="Import" Onclick="import_button()" />
				<button type="button" Onclick = "download_excel()" class="btn btn-info">Download</button>
				<input type="button" name = "import" class="btn btn-dark" value="Format" Onclick="format_button()" />
			</form>
			<br />
			<br />
			<?php 
				if( isset($_GET['sucesso']) ) : ?>
					<div  class="form-group" style="margin: 5px 0px;">
						<div class="alert alert-success" role="alert">
							<?php echo 'ADICIONADO COM SUCESSO'; ?>
						</div>
					</div>
			<?php endif; ?>
		</div>
	</body>
</html>


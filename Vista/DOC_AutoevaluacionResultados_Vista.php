<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_FileUploader.js"></script>

<input type="hidden" name="_section" value="resultados">
<input type="hidden" name="grupoI" value="<?php echo $_SESSION['grupos_documental']['grupoP'] ?>">
<div id="contenido">
	<?php
		include '../Controlador/DOC_graficas.php';
		//include '../Controlador/DOC_graficasPrograma.php';
    ?>
</div>

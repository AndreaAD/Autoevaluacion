<?php
$datos=array("tipo"=>"una-columna",// (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Encuestas", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-izquierda", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);

$datos=array(
            "icono"=>"cog",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Administrar Preguntas",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_subMenu(this,'ENC_administrarPreguntas_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Construir encuestas normales",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_seleccionEncuestaNormal_controlador.php');");//"enc_cargarSeleccionEvidencia(this,'ENC_seleccionEvidencia_controlador.php','ENC_crearEncuesta_controlador.php','Seleccion de evidencia - Construir encuesta');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Informacion basica encuestas",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_publicarEncuesta_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Administrar Tipo Respuesta",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_administrarTipoPregunta_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Exportar Encuestas",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_exportarEncuestas_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Cargar Informacion de Preguntas",//(necesario) valor que mostrar el boton
            "onclick"=>"");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);
$objComp->cerrar_div_bloque_principal();

$datos=array("id"=>"bloque-submenu",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}          
$objComp->bloque_div_normal($datos);

$objComp->cerrar_bloque_div_normal();
?>
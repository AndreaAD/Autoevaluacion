<?php
 
$objComponentes=new Elementos();
    
$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Subir Evidencia Por Grupo de Inter&eacute;s", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
            
$objComponentes->div_bloque_principal($datos);

    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
    
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento
                    
                    
        $objComponentes->input_hidden($datos);
        
        /////////////////////////////////input file//////////////////////////////////////////////////
        $datos = array(
                    "id"=>"file",//(no necesario)el id que tendra el input
                    "name"=>"file[]", // (necesario) define el name del campo
                    "label"=>"Agregar Evidencia a un Grupo de Inter&eacute;s",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "required"=>"on"//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    );
                            
        $objComponentes->input_file ($datos);
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"subir",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                    "value"=>"Enviar",//(necesario) valor que mostrar el boton
                    "onclick"=>"EnviarFile('../Controlador/CNA_Subir_Archivo_Evidencia_Grupo_Interes_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
        ///////////////////////////////ventana Emergente//////////////////////////////////////////////        
        $datos=array("id"=>"ventana-error",// (necesario) id de la ventana
            "ancho"=>"30",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"auto",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
            
        $objComponentes->bloque_div_flotante($datos);
        
        echo $mensaje;
         
        $objComponentes->cerrar_bloque_div_flotante();
        
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>
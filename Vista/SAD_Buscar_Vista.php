
<link href="../Css/demo_table.css" rel="stylesheet" type="text/css"/> 

<script type="text/javascript" src="../Js/jquery.js"></script>
<script type="text/javascript" src="../Js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../Js/SAD_Table.js"></script>
    
<?php
            
$objComponentes=new Elementos();
                
$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>$strNombreBuscador, // (no necesario) titulo del bloque
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
        
        //////////////////////////tabla /////////////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado",
                    "valor_radio"=>$intValorRadio,
                    "valor_col1"=>$intElementoCol1,
                    "valor_col2"=>$intElementoCol2,
                    "Checked" => $strChecked,
                    "CheckedCampo" => $strCheckedCampo,
                    "CheckedValor" => $strCheckedValor,
                    "CheckedElemento" => $strCheckedElemento,
                    "nombreCol1" => $strNombreCol1,
                    "nombreCol2" => $strNombreCol2,
                    "nombreCol3" => $strNombreCol3
                    ); // (necesario) define el name que tendra el campo
                    
        $objComponentes->table($datos, $resSql);
        
        $objComponentes->div_br();
        $objComponentes->div_br();
        $objComponentes->div_br();
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                    "value"=>$strNombreBoton,//(necesario) valor que mostrar el boton
                    "onclick"=>$strFuncion// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
          
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>
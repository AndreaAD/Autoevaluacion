<script type='text/javascript' >

$('#calendario-fechaI').toggle();
    
</script>
<?php
require('../Modelo/CNA_Calendario_Modelo.php');
    
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Agregar Proceso", // (no necesario) titulo del bloque
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
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"nombre",//(no necesario)define el id que tendra el campo
                    "name"=>"nombre", // (necesario) define el name del campo
                    "label"=>"Nombre",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Nombre",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"50",//(no necesario) El atributo maxlength especifica el n�mero m�ximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor dijite el nombre",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_nombre"
                    );
                    
        $objComponentes->input_text($datos);
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"fechaI",//(no necesario)define el id que tendra el campo
                    "name"=>"fechaI", // (necesario) define el name del campo
                    "label"=>"Fecha Inicio",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Fecha Inicio",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el n�mero m�ximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor digite la fecha de inicio",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_fechaI",
                    "formulario"=>"formulario"
                    );
                    
        $objComponentes->input_text_calendario($datos);
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"fechaF",//(no necesario)define el id que tendra el campo
                    "name"=>"fechaF", // (necesario) define el name del campo
                    "label"=>"Fecha Finalizaci&oacuten",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Fecha Finalizaci&oacute;n",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el n�mero m�ximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor digite la fecha de finalizaci&oacute;n",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_fechaF",
                    "formulario"=>"formulario"
                    );
                    
        $objComponentes->input_text_calendario($datos);
        
        ///////////////////////////textarea//////////////////////////////
        $datos=array(
                    "id"=>"descripcion",//(no necesario)define el id que tendra el campo
                    "name"=>"descripcion", // (necesario) define el name del campo
                    "label"=>"Descripci&oacute;n",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Descripci&oacute;n",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"150",//(no necesario) El atributo maxlength especifica el n�mero m�ximo de caracteres permitidos en el elemento
                    "help"=>"Por favor digite una descripci&oacute;n",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_descripcion"
                    );
                    
        $objComponentes->textarea($datos);
        
        ///////////////////////////textarea//////////////////////////////
        $datos=array(
                    "id"=>"observacion",//(no necesario)define el id que tendra el campo
                    "name"=>"observacion", // (necesario) define el name del campo
                    "label"=>"Observaci&oacute;n",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Observaci&oacute;n",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"150",//(no necesario) El atributo maxlength especifica el n�mero m�ximo de caracteres permitidos en el elemento
                    "help"=>"Por favor digite una observaci&oacute;n",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_observacion"
                    );
                    
        $objComponentes->textarea($datos);
        
        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"sede",//(no necesario)el id que tendra el select
                    "name"=>"sede",// (necesario) nombre que tendra el select
                    "label"=>"Sede",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_sede",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_sede",
                    "onchange"=>"FiltrarDato('../Controlador/CNA_Agregar_Proceso_Controlador.php', 'programa');",
                    "selected"=>$pk_sede
                    );
                         
        $objComponentes->select_sql ($resSqlSede,$datos);

        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"facultad",//(no necesario)el id que tendra el select
                    "name"=>"facultad",// (necesario) nombre que tendra el select
                    "label"=>"Facultad",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_facultad",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_facultad",
                    "onchange"=>"FiltrarDato('../Controlador/CNA_Agregar_Proceso_Controlador.php', 'programa');",
                    "selected"=>$pk_facultad
                    );
                         
        $objComponentes->select_sql ($resSqlFacultad,$datos);

        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"programa",//(no necesario)el id que tendra el select
                    "name"=>"programa",// (necesario) nombre que tendra el select
                    "label"=>"Programa",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_programa",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_programa",
                    "disable"=>$strEstadoPrograma
                    );
                         
        $objComponentes->select_sql ($resSqlPrograma,$datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"button",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                    "value"=>"Enviar",//(necesario) valor que mostrar el boton
                    "onclick"=>"ValidarDatosProceso('../Controlador/CNA_Agregar_Proceso_Controlador.php', this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
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
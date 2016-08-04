<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'modificar':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $sqlUsu = $modelo->Ver_X_Usuario($_POST);
            
            $modelo = new Tipo_Usuario();
            
            $sqlTipUsu = $modelo->Ver_X_Usuario($_POST);
            
            modificar();            
    
        }break;
        
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Usuario();
            
            $mensaje = $modelo->Modificar($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar':{
            
            filtrar();            
                 
        }break;
        
        default:{
            
            vista();
            
        }break;
    
    }
}
else{
    vista();
}

function LinesBasicas(){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once('../Vista/VIS_Elementos_Vista.php');
    
    require_once('../Modelo/SAD_Usuario_Modelo.php');
    
    require_once("../Modelo/SAD_Rol_Modelo.php");
    require_once("../Modelo/SAD_Sede_Modelo.php");
    require_once("../Modelo/SAD_Facultad_Modelo.php");
    require_once("../Modelo/SAD_Programa_Modelo.php");
    require_once("../Modelo/SAD_Tipo_Usuario_Modelo.php");
    
}

function modificar(){
    
    LinesBasicas();
    
    $mensaje = "";
    
    global $sqlUsu, $sqlTipUsu;
    
    $claMod = new Rol();
    $resSqlRol = $claMod->Ver();
    
    $claMod = new Sede();
    $resSqlSede = $claMod->Ver();
    $pk_sede = "0";
                   
    $claMod = new Facultad();
    $resSqlFacultad = $claMod->Ver();
    $pk_facultad = "0";
                   
    $claMod = new Programa();
    $resSqlPrograma = $claMod->Ver();
    $strEstadoPrograma = "on";
                    
    $claMod = new Tipo_Usuario();
    $resSqlTipo = $claMod->Ver();
        
    require_once('../Vista/SAD_Modificar_Usuario_Vista.php');
}

function filtrar(){
    
    LinesBasicas();
    
    $datosSelect = "off";
    
    $datosFiltro = array();
    
    $mensaje = "";    
    
    $pk_sede = $_POST['sede'];
    
    $pk_facultad = $_POST['facultad'];
    
    if($_POST['sede'] != 0 && $_POST['facultad'] != 0){
                       
        $claMod = new Programa();
        $resSqlPrograma = $claMod->Ver_Sede_X_Facultad($_POST);
        
        ?>
        <option value="0">sin seleccionar</option>
        <?php
        
        while(!$resSqlPrograma->EOF){
            
            ?>
            <option value="<?php echo $resSqlPrograma->fields['pk_programa'];?>"><?php echo $resSqlPrograma->fields['nombre'];?></option>
            <?php
            
            $resSqlPrograma->MoveNext();
        }
        
    }
    else{        
            
        $claMod = new Programa();
        $resSqlPrograma = $claMod->Ver();
        
        ?>
        <option value="0">sin seleccionar</option>
        <?php
        
        while(!$resSqlPrograma->EOF){
            
            ?>
            <option value="<?php echo $resSqlPrograma->fields['pk_programa'];?>"><?php echo $resSqlPrograma->fields['nombre'];?></option>
            <?php
            
            $resSqlPrograma->MoveNext();
        }                        
            
    }
    
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;
    
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = '';
    $strValorHiddenTer = ''; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();  
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    $modelo = new Usuario();
    
    $resSql = $modelo->Ver();
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes de la sede y la facultad */
    
    $modelo = new Sede();
    
    $resSqlOtro = $modelo->Ver();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_sede",
                            "pk"=>$resSqlOtro->fields['pk_sede'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    $modelo = new Programa();
    
    $resSqlOtro = $modelo->Ver();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_programa",
                            "pk"=>$resSqlOtro->fields['pk_programa'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    $modelo = new Facultad();
    
    $resSqlOtro = $modelo->Ver();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_facultad",
                            "pk"=>$resSqlOtro->fields['pk_facultad'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    /*************************************************************************************/
    
    $strNombreBuscador = 'Modificar Usuarios';
    
    $strNombreHidden = 'pk_usuario';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Apellido",
                        "col4"=>"Estado",
                        "col5"=>"Sede",
                        "col6"=>"Facultad",
                        "col7"=>"Programa"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_usuario",
                        "contenido_1"=>"nombre",
                        "contenido_2"=>"apellido",
                        "estado"=>"estado",
                        "filtro_1"=>"fk_sede",
                        "filtro_2"=>"fk_facultad",
                        "filtro_3"=>"fk_programa"                         
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Modificar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Modificar_Usuario_Controlador.php', 'modificar');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>

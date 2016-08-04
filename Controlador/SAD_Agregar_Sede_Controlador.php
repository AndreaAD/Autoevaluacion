<?php

session_start();

require_once("../Vista/VIS_Elementos_Vista.php");

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Sede();
        
            $mensaje = $modelo->Agregar($_POST);
            
            mensaje();
            
        }break;
        
        default:{            
            vista();            
        }break;
    }
}
else{
    vista();
}

function lineasBasicas(){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Modelo/SAD_Sede_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    $mensaje = "";
    
    require_once("../Vista/SAD_Agregar_Sede_Vista.php");
    
}

function mensaje(){
    
    lineasBasicas();
    
    global $mensaje;
    
    require_once("../Vista/SAD_Agregar_Sede_Vista.php");
    
}

?>
<?php
error_reporting(0);
class Respuestas{
    public function getDatosRespuestas($_idPregunta=-1){
        if($_idPregunta!=-1){
            require_once("../baseDatos/AdoDB.php");
            $conDB=new Ado();
            $sql="SELECT rp.pk_respuesta_pregunta,rp.texto,po.pk_respuesta_ponderacion,po.ponderacion FROM enc_respuesta_pregunta as rp, respuesta_ponderacion as po WHERE fk_pregunta=".$_idPregunta." AND po.pk_respuesta_ponderacion=rp.fk_respuesta_ponderacion";
            $rsDatos = $conDB->conectarAdo($sql);
            return $rsDatos;
        }else{
            return null;
        }
    }
}
?>
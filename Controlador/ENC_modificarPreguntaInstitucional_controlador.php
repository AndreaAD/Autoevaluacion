<?php
session_start();
$idProceso=$_SESSION["pk_proceso"];
//echo "modificar institucional";
$idPregunta=$_REQUEST["idPregunta"];
//echo $idPregunta;
require_once("../Modelo/ENC_preguntas_modelo.php");
require_once("../Modelo/ENC_respuestas_modelo.php");
require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
require_once("../Modelo/ENC_gruposInteres_modelo.php");
require_once("../Vista/elementos_vista.php");

$objPregunta=new Preguntas();
$rsDatosPregunta=$objPregunta->getUnaPregunta($idPregunta);
//p.pk_pregunta  p.texto  tr.pk_tipo_respuesta  tr.cantidad_respuestas

$pkPregunta=$rsDatosPregunta->fields[0];
$textoPregunta=$rsDatosPregunta->fields[1];
$pkTipoRespuesta=$rsDatosPregunta->fields[2];
$cantidadRespuestas=$rsDatosPregunta->fields[3];

$objRespuestas=new Respuestas();
$rsDatosRespuestas=$objRespuestas->getDatosRespuestas($idPregunta);
//rp.pk_respuestas_pregunta  rp.texto  po.pk_respuesta_ponderacion  po.ponderacion

$objTipoRes=new TiposRespuesta();
$rsCantidadRes=$objTipoRes->getCantidadRespuestas();
$arrayTipoRespuestas=$objTipoRes->getTiposRespuesta($cantidadRespuestas);
$rsDatosPonderacion=$objTipoRes->getValoresRespuesta($pkTipoRespuesta);
$rsDatosPonderacion=$rsDatosPonderacion->GetArray();
//pk_respuesta_ponderacion  ponderacion

$objGuposInteres=new GruposInteres();
$rsGruposInteres=$objGuposInteres->getGruposEncuestasInstitucionales();
$arrayGruposInteres=$objGuposInteres->gruposInteresUnaPreguntaInstitucional($idPregunta,$idProceso);

$objComp=new Elementos();
require_once("../Vista/ENC_modificarPreguntaInstitucional_vista.php");
?>
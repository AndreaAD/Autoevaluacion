<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_InfoAdicional.js"></script>
<input type="hidden" name="_section" value="infoAdicional"> 
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Agregar instrumento de evaluación</h2>
    </div>
    <input type="hidden" name="instrumento" value="">
      <div class="div_formularios">
            <?php  require_once("elementos_vista.php");
            $objComp=new Elementos(); ?>
            <label style="font-weight:bold;font-size:1.3em; display:inline-block; float:left;margin-bottom: 15px;" for="texto-factor" >Grupo interés</label>
            <div id="div_chechbox" style="display:inline-block; float: left; margin-left: 40px;}"></div>
        <div class="row">
            <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Factor</label>
            <button type="button" id="A_factor" class="boton-solo-icono"><i class="icon-redo2"></i></button>
            <textarea id="factor" style="width:90%; height:50px;" placeholder="Seleccione un factor" id="texto-factor" readonly="on"></textarea>
        </div>
        <div class="row">
            <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Característica</label>
            <button  type="button" id="A_caracteristica" class="boton-solo-icono"><i class="icon-redo2"></i></button>
            <textarea id="caracteristica" style="width:90%; height:50px;" placeholder="Seleccione una caracteristica" id="texto-factor" readonly="on"></textarea>
        </div>
        <div class="row">
            <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Aspecto</label>
            <button  type="button" id="A_aspecto" class="boton-solo-icono"><i class="icon-redo2"></i></button>
            <textarea id="aspecto" style="width:90%; height:50px;" placeholder="Seleccione un aspecto" id="texto-factor" readonly="on"></textarea>
        </div>
        <div class="row">
            <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Evidencia</label>
            <button  type="button" id="A_evidencia" class="boton-solo-icono"><i class="icon-redo2"></i></button>
            <textarea id="evidencia" style="width:90%; height:50px;" placeholder="Seleccione una evidencia" id="texto-factor" readonly="on"></textarea>
        </div>
        <div class="row">
            <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Instrumento </label>
            <button type="button" id="A_instrumento" class="boton-solo-icono"><i class="icon-redo2"></i></button>
            <textarea id="instrumento" style="width:90%; height:50px;" placeholder="Seleccione un instrumento" id="texto-factor" readonly="on"></textarea>
        </div>
        <div class="row">
            <div class="col">
                 <a id="A_instrumento" href="#">Seleccionar los archivos </a>
            </div>
            <div class="col_2">
                 <input id="F_archivos" type="file" name="archivos[]" multiple="multiple" />
            </div>
        </div>
        <div class="row">
            <br>
              <input type="button" id="B_agregarInfoAdicional" value="Guardar">
            <br><br>
        </div>
        <div class="row">
          <table class="tabla2" id="tabla_agregar_info">
          </table>
        </div>
        <br><br>
    </div>
    <div class="errores"></div>
      <div id="div_emergente" class="fondo_emergente">
        <div class="emergente">
            <div data-role="contenido"></div>
            <div data-role="botones"></div>
          <span title="cerrar" data-rol="cerrar"> x </span>
      </div>
    </div>
</div>
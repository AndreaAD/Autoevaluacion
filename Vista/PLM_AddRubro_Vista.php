<?php
class AddRubroView{
 
    //aqui se agregan los rubros del poai
    public function guardar(){
    ?>
    <meta charset="UTF-8">
    <br />
    <br />
        <form id="guardar" method="post">
            <input type="hidden" id="H_opcion" name="H_opcion" value="guardar" />
           
    <div class="bloque una-columna-centro-medio">
      <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill">Agregar Rubro del P.O.A.I</h2>
      </div>
      <br />
                    <label>Rubro</label> 
                
                    <input id="T_nombre" name="T_nombre" type="text" size="30" />
               
            <br />
            <input type="button" value="Guardar" id="B_guardar" onclick="add();" />

    </div> 
    </form>
	
	
		
		<div class="errores"></div>
			<div id="div_emergente" class="fondo_emergente">
				<div class="emergente">
					<div data-role="contenido"></div>
					<div data-role="botones"></div>
					<span title="cerrar" data-rol="cerrar"> x </span>
				</div>
			</div>
		</div>
		
<?PHP
    }
    
    //mensaje de advertencia
    public function mensaje($strMensaje)
    {
      ?> 
		<div class="errores"></div>
			<div id="div_emergente" class="fondo_emergente">
				<div class="emergente">
					<div data-role="contenido"></div>
					<div data-role="botones"></div>
					<span title="cerrar" data-rol="cerrar"> x </span>
				</div>
			</div>
		</div>
	  <script>
	  
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2><?php echo $strMensaje;?></h2></p>');
		div_emergente.css('display','block');	
	  </script>
      <?php
    }
}
?>

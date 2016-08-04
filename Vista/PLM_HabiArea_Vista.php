
<?php

class SelAreaView
{
    //muestra las areas deshabilitadas
    public function buscaArea($areas)
    {
        ?>
        <br />
        <br />
        <form id="buscar" name="buscar" method="post" >
            <input type="hidden" id="H_opcion" name="H_opcion" value="ver" />
            
            <div class="bloque una-columna-centro-medio">
              <div class="titulo-bloque texto-izquierda">
                  <h2 class="icon-quill"><?php echo utf8_encode("Habilitar �rea");?></h2>
              </div>
              <br />
              <?php
              if($areas[0][0])
              {
              ?>
                <table border="0" align="center">
                     <tr>
                        <td>
                            <label><?php echo utf8_encode("�rea");?></label>   
                        </td>
                        <td>
                            <select name="S_area">
                            <?php
                            for($i=0; $i<count($areas); $i++)
                            {
                                ?>
                                <option value="<?php echo $areas[$i][0];?>"> <?php echo utf8_encode($areas[$i][1]);?> </option>
                                <?php
                            }
                            ?>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <input type="button" value="Buscar" id="B_buscar" onclick="busca();" />
                        </td>
                     </tr>
                </table>
              <?php
              }
              else
              {
                ?>
                <h3><?php echo utf8_encode("No hay �reas Deshabilitadas!!!");?></h3>
                <?php
              }
              ?>
            </div>
        </form>
        <?php    
    }
    
    //imprime el area en detalle para habilitarlo
    public function imprime($arrArea)
    {
    ?>
    <br />
    <br />
    <form id="habilitar" method="post">
    <div class="bloque una-columna-centro-medio">
      <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill"><?php echo utf8_encode("Habilitar �rea");?></h2>
      </div>
        <input type="hidden" id="H_opcion" name="H_opcion" value="habilitar"  />
        
    <table border="0" align="center">
        <?php
        
        if($arrArea[0][0])
        {
        ?>
         <tr>         
            <td>
                <label><?php echo utf8_encode("C�digo");?></label>   
            </td>
            <td>
                <input type="hidden" id="T_codigo" name="T_codigo" value="<?php echo $arrArea[0][0];?>"  size="11" /><?php echo $arrArea[0][0];?>
            </td>
         </tr>
         <tr>
            <td>
                <label><?php echo utf8_encode("�rea");?></label> 
            </td>
            <td>
                <label><?php echo utf8_encode($arrArea[0][1]);?></label> 
            </td>
         </tr>
         
         <tr>
            <td>
                <input type="button" value="Habilitar" id="B_guardar" onclick="habi();" />
            </td>
         </tr>
          <?php
          }
             else
            {
                ?>
                <tr>
                    <td><?php echo utf8_encode("La �rea NO EXISTE!!");?></td>
                </tr>
                <?php
            }
        ?>
    </table>
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
		
    </div>
    
    
    <?php
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
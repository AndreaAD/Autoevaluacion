$(function(e){



    var pagina = 1; 
    var items = 4;
    var num_paginas = 0;
    var div_emergente = $('#div_emergente');
    var _divOculto = $("#div_contenido_completo");

    var cargarRespuestas = function(){
        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var _id_pregunta =  $(this).data('rel-pregunta');
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                method: 'post',
                dataType:'json',
                async: false,
                data: {
                    operacion: 'obtenerRespuestas',
                    idgrupo: $('input[name="grupoI"]').val(),
                    id_pregunta: _id_pregunta
                },
                success:  function (data) {
                    if(data.length > 0){
                        if(data[0].respuesta == 10006){
                            $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] input[data-role="respuesta"]').val(data[0].respuesta_6);
                        }else if( data[0].respuesta == 10007 ){
                            $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] input[data-role="respuesta"]').val(data[0].respuesta_7);
                        }else{
                            $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] select[data-role="respuesta"]').find('option[data-id="'+data[0].respuesta+'"]').attr('selected' , 'selected');
                        }
                        $('div.pregunta[data-rel-pregunta="'+_id_pregunta+'"] textarea[data-role="observaciones"]').val(data[0].observaciones);
                    }
                }
            });
        });
    }

    var obtenerPorcentaje = function(){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'obtenerPorcentaje',
                idgrupo: $('input[name="grupoI"]').val()
            },
            success:  function (data){
                var porcentaje = 0;
                if(data.institucional == 0)
                    porcentaje = data.porcentaje_programa;
                else
                    porcentaje = data.porcentaje_institucional;

                $('#progreso-total .principal').text(porcentaje+"%");
                $('#progreso-total .progreso ').css('width', porcentaje+'%');

                if(data.estado == 1 && data.institucional == 0){
                    $('#emergentefinal').find('.emergente > div[data-role="contenido"]').html('<div id="titulo_final" class="row"><p class="mensaje_principal">Ha diligenciado todas las preguntas satisfactoriamente para finalizar esta etapa de click <a href="#" id="finalizar_etapa">aquí</a></p></div>');
                    $('#emergentefinal').fadeIn();
                    /*$('#titulo_final').remove();
                    var mensaje = '<div id="titulo_final" class="row">';
                        mensaje += '<div class="titulo alerta">';
                            mensaje += '<h4>Mensaje</h4>';
                        mensaje += '</div>';
                        mensaje += '<div><p class="mensaje_principal">Ha diligenciado todas las preguntas satisfactoriamente para finalizar esta etapa de click <a href="#" id="finalizar_etapa">aquí</a></p></div>';
                        mensaje += '</div>';
                    _divOculto.prepend(mensaje);*/
                }else{
                    /*$('#titulo_final').remove();*/
                }

            }
        });
    }


    var verificarPendientes = function(){

        $("#div_contenido_completo div.pregunta").each(function(i, e){
            var select = $(this).find('select[data-role="respuesta"]');
            var archivos = $(this).find('.file-uploader table.archivos');
            var textarea = $(this).find('textarea[data-role="observaciones"]');
            
            if(select.val() == 0){
                select.closest('.validador').find('label').addClass('pendiente');
            }else{
                select.closest('.validador').find('label').removeClass('pendiente');
            }

            if(archivos.find('tr').length < 1){
                archivos.closest('.validador').find('label').addClass('pendiente');
            }else{
                archivos.closest('.validador').find('label').removeClass('pendiente');
            }

            if(textarea.val() == ''){
                textarea.closest('.validador').find('label').addClass('pendiente');
            }else{
                textarea.closest('.validador').find('label').removeClass('pendiente');
            }
        });     
    }




    var cargarControlador = function(_pagina){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarInformacionFactor',
                alcance:  $("input[name='alcance']").val(),
                items: items,
                pagina: _pagina,
            },
            success:  function (data) {
            	var div_preguntas = $('#div_preguntas');
            	var div_procesos = $('#div_procesos');
            	div_preguntas.html("");
            	div_procesos.html("");
                var lista_p = '';
                var lista_procesos = '';


                var lista_preguntas = [];

                $.each( data, function( key, value ) {
				  	$.each( value, function( key_2, value_2 ) {
				  		$.each( value_2, function( key_3, value_3 ) {
				  			if(key_3 == 'pk_instru_evaluacion'){
								if( lista_preguntas.indexOf(value_3) == -1 ){
				  					lista_preguntas.push(value_3);
				  					lista_p += '<span class="titulo_pregunta">'+value_2['pregunta']+'</span><br>';
				  				}
				  				
					  		}
						});
						lista_procesos += '<div class="procesos_lado" style="width:10%; display:inline-block;float:left; padding:5px;">';
				  			lista_procesos += '<div class="Titulo_proceso">';
				  				lista_procesos += '<span>'+value_2['nombre_proceso']+'</span>';
				  			lista_procesos += '</div>';
				  		lista_procesos += '</div>';
					});
				});


                div_preguntas.html(lista_p);
                div_procesos.html(lista_procesos);

                //console.log(lista_preguntas);



                // _divOculto.html("");
                // var lista = '';
                // var form = '<form>';
                // for(var i = 0; i<data.length; i++){
                //     form += '<div class="row">';
                //         // form += '<div class="titulo">';
                //             // form += '<h4>'+data[i].caracteristica_codigo+'.'+data[i].caracteristica_nombre+'</h4>';
                //         // form += '</div>';
                //             form += '<div class="pregunta" data-rel-pregunta="'+data[i].pk_instru_evaluacion+'">';
                //                 form += '<div>';
                //                     form += '<p class="titulo_pregunta">'+data[i].pregunta+'</p>';
                //                 form += '</div>';
                //                 if(data[i].respuestas.length == 1 ){
                //                     if (data[i].respuestas[0].fk_tipo_respuesta == 6){
                //                         form += '<label>Seleccione el porcentaje</label>';
                //                         form += '<input type="number" min="1" max="100" name="respuesta-porc" data-role="respuesta" data-tipo="numero" data-id-tipo-respuesta="10006">';
                //                         form += '<span style="font-size: 10px; margin-left: 5px;">El maximo para la escala porcentual es: ' +data[i].porcentaje+' </span>';
                //                     }
                //                     if (data[i].respuestas[0].fk_tipo_respuesta == 7){
                //                         form += '<label>Seleccione el valor ideal </label>';
                //                         form += '<input type="number" min="1" max="100" name="respuesta-porc" data-role="respuesta" data-tipo="numero" data-id-tipo-respuesta="10007">';
                //                         form += '<span>El maximo valor ideal es: ' +data[i].porcentaje+' </span>';
                //                     }
                //                 }else{
                //                     form += '<div class="validador">';
                //                         form += '<label>Seleccione la respuesta</label>';
                //                         form += '<select data-role="respuesta" data-tipo="selector">';
                //                         form += '<option data-id="0" value="0"></option>';
                //                             for( var k = 0; k<data[i].respuestas.length; k++){
                //                                 form += '<option data-id="'+data[i].respuestas[k].pk_respuestas_pregunta+'" value="'+data[i].respuestas[k].ponderacion+'">'+data[i].respuestas[k].texto+'</option>';
                //                             }
                //                         form += '</select>';
                //                     form += '</div>';
                //                 }
                                
                //                 if(data[i].informacion.length > 0){
                //                 form += '<div>';
                //                     form += '<label>Es recomendado diligenciar la informacion adicional</label>';
                //                     form += '<div class="table">';
                //                         form += '<table class="archivos">';
                //                             for(var l = 0; l<data[i].informacion.length; l++){
                //                                 form += '<tr>';
                //                                 form += '<td><a class="file" href="'+data[i].informacion[l].url+'" target="_blank">'+data[i].informacion[l].nombre+'</a></td>';
                //                                 form += '</tr>';
                //                             }
                //                         form += '</table>';
                //                     form += '</div>';
                //                 form += '</div>';
                //                 }
                //                 form += '<div class="validador">';
                //                     form += '<label>Seleccione el(los) documento(s) de informacion adicional que sustentan su respuesta</label>';
                //                     form += '<div class="file-uploader" data-rel="'+data[i].pk_instru_evaluacion+'">';
                //                         form += '<input type="file"><a href="#" data-op="cargar_info" data-rel="'+data[i].pk_instru_evaluacion+'" class="subir">Cargar</a><br>';
                //                         form += '<div class="progress-bar"><div class="progresoinfo"></div></div>';
                //                         form += '<div class="table">';
                //                             if(data[i].informacionadicional.length > 0){
                //                                 form += '<table class="info">';
                //                                     for(var t = 0; t<data[i].informacionadicional.length; t++){
                //                                         form += '<tr data-id="'+data[i].informacionadicional[t].pk_documento+'"><td><a  href="'+data[i].informacionadicional[t].url+'" target="_blank">'+data[i].informacionadicional[t].nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
                //                                     }
                //                                 form += '</table>';
                //                             }else{
                //                                 form += '<table class="info">';
                //                                 form += '</table>';
                //                             }
                //                         form += '</div>';
                //                     form += '</div>';
                //                 form += '</div>';
                //                 form += '<div class="validador">';
                //                     form += '<label data-role="doc">Seleccione el(los) documento(s) que sustentan su respuesta</label>';
                //                     form += '<div class="file-uploader" data-rel="'+data[i].pk_instru_evaluacion+'">';
                //                         form += '<input type="file"><a href="#" data-op="cargar_doc" data-rel="'+data[i].pk_instru_evaluacion+'" class="subir">Cargar</a><br>';
                //                         form += '<div class="progress-bar"><div class="progreso"></div></div>';
                //                         form += '<div class="table">';
                //                             if(data[i].documentos.length > 0){
                //                                 form += '<table class="archivos">';
                //                                     for(var m = 0; m<data[i].documentos.length; m++){
                //                                         form += '<tr data-id="'+data[i].documentos[m].pk_documento+'"><td><a  href="'+data[i].documentos[m].url+'" target="_blank">'+data[i].documentos[m].nombre+'</a></td><td><a href="#" data-role="borrar">eliminar</a></td></tr>';
                //                                     }
                //                                 form += '</table>';
                //                             }else{
                //                                 form += '<table class="archivos">';
                //                                 form += '</table>';
                //                             }
                //                         form += '</div>';
                //                         if ($('input[name="grupoI"]').val() == "Equipo del Programa"){
                //                             form += '<a href="#" data-role="nuevosArchivos" data-id-instru="'+data[i].pk_instru_evaluacion+'" class="subir_nuevos">Archivos de procesos anteriores</a>';
                //                         }
                //                     form += '</div>';
                //                 form += '</div>';
                //                 form += '<div class="validador">';
                //                     form += '<label>Recomendaciones</label>';
                //                     form += '<textarea data-role="observaciones"></textarea>';
                //                 form += '</div>';
                //             form += '</div>';

                //     form += '</div">';
                // }
            },complete: function(){
                // cargarRespuestas();
                // verificarPendientes();
                // obtenerPorcentaje();
                _divOculto.removeClass('hide');
            }
        });
    }

	var cargarPaginador = function(){
        $.ajax({
            url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data:{
                operacion: 'obtenerTotalInstrumentos',
                seccion :  $("input[name='_section']").val()
            },
            success:function (data){
                num_paginas = data / items;
                $('div[data-role="paginador"]').empty();
                for (var i = 0; i < num_paginas; i++) {
                    $('div[data-role="paginador"]').append('<a href="#" data-rel="'+i+'" class="'+(i == 0 ? 'active' : '')+'">'+(i+1)+'</a>');
                }
                $('div[data-role="paginador"]').prepend('<input type="button" value="Guardar">');
            }
        });
    }

        div_emergente.delegate('input[data-role="agregar_archivos"]','click', function(e){
        $('input[name="checkboxArchivos[]"]:checked').each(function(e){
            var tr = $(this).closest('tr');
            $.ajax({
                url: '../Controlador/DOC_Autoevaluacion_Controlador.php',
                type:  'post',
                dataType:'json',
                async: false,
                data:{
                    operacion: "guardarArchivosExistentes",
                    pk_documento: tr.data('pk_documento'),
                    programa: tr.data('programa'),
                    sede: tr.data('sede')
                },
                success:  function (data) {
                    if(data == 1){

                    }else{

                    }
                }
            });
        });
        var pag = $('#paginador .active').data('rel');
        if(pag == ''){
            pag = 0;
        }
        cargarControlador(pag, $("input[name='grupoI']").val());
        div_emergente.css('display','none');
        e.preventDefault();
    });
    
        /**
     * cargar lista de archivos para un instrumento
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    $('#div_contenido_completo').delegate('a[data-role="nuevosArchivos"]', 'click', function(e){
        var id = $(this).data('id-instru');
        var seccion = $('input[name="grupoI"]').val();
        $.ajax({
            url: '../Controlador/DOC_InfoAdicional_Controlador.php',
            method: 'post',
            dataType:'json',
            async: false,
            data: {
                operacion: 'cargarDocumentosEmergente',
                id_instru: id,
                seccion: seccion
            },
            success:  function (data) {
                if(data == 0){
                    div_emergente.find('.emergente > div[data-role="contenido"]').html('<p>No existen documentos anteriores para este instrumento. </p>');
                    div_emergente.find('.emergente > div[data-role="botones"]').html('');
                    div_emergente.css('display','block');
                    /*recargartablarespuestas();*/
                }else{
                    var lista = '<div class="row">';
                        lista += '<table class="archivos_emergente" data-role="archivos_existentes"><tr><td>Archivo</td><td>Descargar</td><td>Seleccionar</td></tr>'
                            for(var i = 0; i < data.length; i++){
                                lista += '<tr data-pk_documento="'+data[i].pk_documento+'" data-programa="'+data[i].fk_programa+'" data-sede="'+data[i].fk_sede+'" ><td><a href="#" data-id="'+data[i].pk_documento+'">'+data[i].fecha+' | '+data[i].nombre+'</a></td><td><a href="'+data[i].url+'" target="_blank" style="color:#f00;">Descargar</a></td><td><input type="checkbox" name="checkboxArchivos[]" value="'+data[i].pk_documento+'" /></td></tr>';
                            }
                        lista += '</table>';
                    lista += '</div>';
                    div_emergente.find('.emergente > div[data-role="contenido"]').html(lista);
                    div_emergente.find('.emergente > div[data-role="botones"]').html('<input type="button" id="agregar_archivos_existentes" data-role="agregar_archivos" value="Agregar" />');
                    div_emergente.css('display','block');
                }   
            }
        });
        e.preventDefault();
    });


	cargarControlador(0);
    //cargarPaginador();

    $('div[data-role="paginador"]').delegate('a', 'click', function(e){
        var pag = $(this).data('rel');
        $('div[data-role="paginador"] a').each(function(i,e){
            $(this).removeClass('active');
        });
        guardarRespuestasPreguntas();
        cargarControlador(pag);
        $(this).addClass('active');
        e.preventDefault();
    });

    $('div[data-role="paginador"]').delegate('input[type="button"]', 'click', function(e){
        guardarRespuestasPreguntas();
    });



});
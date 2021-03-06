<?php
class Analisis
{   
	//inicializa la coneccion con la base de datos
    function conectar()
    {
        global $conexion;
        include("../BaseDatos/PLM_AdoDB.php");
        
        $conexion = new Ado();
        
    }
    
    //buscar el proceso en la base cna
    function buscarProceso($intIdProceso, $intIdUsuario)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "                          
                    SELECT G.nombre, C.nombre, B.nombre, A.fecha_inicio, CONCAT( E.nombre,' ', E.apellido) AS nombre
                    FROM cna_proceso A, sad_sede B, sad_programa C, cna_fase D,
                         sad_usuario E, sad_proceso_usuario F, sad_facultad G, sad_usuario_tipo_usuario H, sad_tipo_usuario I
                    WHERE A.pk_proceso = $intIdProceso AND
                          A.fk_programa = C.pk_programa  AND
                          A.fk_sede = B.pk_sede AND
                          D.pk_fase = A.fk_fase AND 
                          D.pk_fase = 5 AND
                          E.pk_usuario = F.fk_usuario  AND
                          A.pk_proceso = F.fk_proceso AND
                          E.fk_programa = C.pk_programa AND
                          G.pk_facultad = C.fk_facultad AND
                          E.pk_usuario = H.fk_usuario AND
                          H.fk_tipo_usuario = I.pk_tipo_usuario AND
                          I.pk_tipo_usuario = 4  ;"; 
                          
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $proce[] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $proce[0]=$recordSet->fields[0];
            $proce[1]=$recordSet->fields[1];
            $proce[2]=$recordSet->fields[2]; 
            $proce[3]=$recordSet->fields[3];
            $proce[4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $proce;    
    }
    //muestra los factores de un proceso con la escala cualitativa
    function mostrarFactorProcesoEscala( $pk_proceso)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = " SELECT A.nombre, B.escala, (((C.calificacion-1)/4)*100) AS porcentaje
                FROM cna_factor A, plm_escala_cualitativa B, plm_factor_proceso C, cna_proceso D
                WHERE C.fk_proceso = $pk_proceso  AND C.fk_proceso = D.pk_proceso  AND B.estado = 1 
                AND C.calificacion >= B.valor_ini AND A.pk_factor = C.fk_factor AND
                C.calificacion <= B.valor_fin ORDER BY A.pk_factor ASC;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i][0]=$recordSet->fields[0];
            $factor[$i][1]=$recordSet->fields[1];
            $factor[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    }
    
    //retorna las caracteristicas de un factor y un proceso, con la escala cualitativa
    function mostrarCaractProcesoEscala( $pk_proceso, $_pk_factor)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = " SELECT A.nombre, B.escala, (((C.calificacion-1)/4)*100) AS porcentaje
                FROM cna_caracteristica A, plm_escala_cualitativa B, plm_caracteristica_proceso C, cna_proceso D
                WHERE C.fk_proceso = $pk_proceso  AND C.fk_proceso = D.pk_proceso  AND B.estado = 1 
                AND C.calificacion >= B.valor_ini AND A.pk_caracteristica = C.fk_caracteristica 
				AND A.fk_factor = $_pk_factor AND
                C.calificacion <= B.valor_fin ORDER BY A.pk_caracteristica ASC;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $caracteristica[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $caracteristica[$i][0]=$recordSet->fields[0];
            $caracteristica[$i][1]=$recordSet->fields[1];
            $caracteristica[$i][2]=$recordSet->fields[2];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $caracteristica; 
    }
    
    //busca evidencia por código
    
    function buscaEvidCod($IdEvi)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_evidencia WHERE estado = 1 and pk_evidencia = $IdEvi ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $evide[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $evide[$i][0]=$recordSet->fields[0];
            $evide[$i][1]=$recordSet->fields[1];
            $evide[$i][2]=$recordSet->fields[2]; 
            $evide[$i][3]=$recordSet->fields[3]; 
            $evide[$i][4]=$recordSet->fields[4]; 
            $evide[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $evide;    
    }
    //busca aspecto por código
    function buscaAspecCod($IdAspec)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_aspecto WHERE estado = 1 and pk_aspecto = $IdAspec ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $aspec[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $aspec[$i][0]=$recordSet->fields[0];
            $aspec[$i][1]=$recordSet->fields[1];
            $aspec[$i][2]=$recordSet->fields[2]; 
            $aspec[$i][3]=$recordSet->fields[3]; 
            $aspec[$i][4]=$recordSet->fields[4]; 
            $aspec[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $aspec;    
    }
    
    //busca carácteristica por código
    function buscaCaractCod($IdCarac)
    {
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_caracteristica WHERE estado = 1 and pk_caracteristica = $IdCarac ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $carac[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $carac[$i][0]=$recordSet->fields[0];
            $carac[$i][1]=$recordSet->fields[1];
            $carac[$i][2]=$recordSet->fields[2]; 
            $carac[$i][3]=$recordSet->fields[3]; 
            $carac[$i][4]=$recordSet->fields[4]; 
            $carac[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $carac; 
    }
    //busca un factor por codigo
    function buscaFactorCod($IdFactor)
    {
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_factor WHERE estado = 1 and pk_factor = $IdFactor ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i][0]=$recordSet->fields[0];
            $factor[$i][1]=$recordSet->fields[1];
            $factor[$i][2]=$recordSet->fields[2]; 
            $factor[$i][3]=$recordSet->fields[3]; 
            $factor[$i][4]=$recordSet->fields[4]; 
            $factor[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $factor; 
    }
    //busca los factores en la base de datos: CNA
    function buscaFactor()
    {
        
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT *  FROM cna_factor WHERE estado = 1 ;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $factor[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $factor[$i][0]=$recordSet->fields[0];
            $factor[$i][1]=$recordSet->fields[1];
            $factor[$i][2]=$recordSet->fields[2]; 
            $factor[$i][3]=$recordSet->fields[3]; 
            $factor[$i][4]=$recordSet->fields[4]; 
            $factor[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
		
        return $factor; 
    }
    
    //buscar las caracteristicas de un factor de la base de datos CNA
    function buscarCarac($intIdFac)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_caracteristica WHERE estado = 1 AND fk_factor = $intIdFac;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $carac[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $carac[$i][0]=$recordSet->fields[0];
            $carac[$i][1]=$recordSet->fields[1];
            $carac[$i][2]=$recordSet->fields[2]; 
            $carac[$i][3]=$recordSet->fields[3]; 
            $carac[$i][4]=$recordSet->fields[4]; 
            $carac[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $carac; 
    }
    //buscar las caracteristicas de un factor de la base de datos CNA
    function buscarAspecto($intIdCarac)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_aspecto WHERE estado = 1 AND fk_caracteristica = $intIdCarac;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $aspec[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $aspec[$i][0]=$recordSet->fields[0];
            $aspec[$i][1]=$recordSet->fields[1];
            $aspec[$i][2]=$recordSet->fields[2]; 
            $aspec[$i][3]=$recordSet->fields[3]; 
            $aspec[$i][4]=$recordSet->fields[4]; 
            $aspec[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $aspec; 
    }
    
    //busca la evidencia por codigo
    function buscarEvi($intIdAspec, $intIdProce)
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT * FROM cna_evidencia A
                    WHERE A.estado = 1 AND A.fk_aspecto = $intIdAspec;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $evi[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $evi[$i][0]=$recordSet->fields[0];
            $evi[$i][1]=$recordSet->fields[1];
            $evi[$i][2]=$recordSet->fields[2]; 
            $evi[$i][3]=$recordSet->fields[3]; 
            $evi[$i][4]=$recordSet->fields[4];
            $evi[$i][5]=$recordSet->fields[5]; 
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $evi; 
    }
    
    //busca la calificacion de los grupos de interes y las observaciones,
    // en la base de CNA y segun el id de la evidencia lo busca
    function buscaCaliGruInte($intIdEvi, $intIdProce)
    {
        global $conexion;
        
        $conexion->conectarAdo();
        
        $cadena = "SELECT B.nombre, B.descripcion, B.estado, C.calificacion, A.fk_evidencia, C.observacion
         FROM cna_evidencia_grupo_interes A, cna_grupo_interes B, cna_resultados_evidencia C 
         WHERE A.fk_grupo_interes = B.pk_grupo_interes AND B.estado = 1 AND A.fk_evidencia = $intIdEvi
         AND C.fk_proceso = $intIdProce AND C.fk_evidencia_grupo_interes = A.pk_evidencia_grupo_interes;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $grupo[][] = array();
        $i=0;
        
        while(!$recordSet->EOF)
        {        
            $grupo[$i][0]=$recordSet->fields[0];
            $grupo[$i][1]=$recordSet->fields[1];
            $grupo[$i][2]=$recordSet->fields[2]; 
            $grupo[$i][3]=$recordSet->fields[3]; 
            $grupo[$i][4]=$recordSet->fields[4]; 
            $grupo[$i][5]=$recordSet->fields[5]; 
            $i++;
            $recordSet->MoveNext();
        }       
        
        return $grupo; 
    }
    
    //busca en la escala de cumplimiento, 
    //en cual rango se encuentra el valor parametrizado 
    function buscaEscala($intValor)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "SELECT escala FROM plm_escala_cualitativa WHERE estado = 1 AND valor_fin >= $intValor AND valor_ini <= $intValor;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $strEsca="";
        
        while(!$recordSet->EOF)
        {        
            $strEsca=$recordSet->fields[0];
            $recordSet->MoveNext();
        }       
        
        return $strEsca; 
    }
    
    
    //busca la ponderacion de una caracteristica en la base plm
    function buscaPondeCarac($intIdFac, $intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "        
        SELECT 	fk_caracteristica, 
        	fk_proceso, 
        	ponderacion, 
        	fortaleza, 
        	debilidad, 
        	analisis
        		 
        	FROM 
        	plm_caracteristica_proceso 
        	WHERE 
        	fk_factor = $intIdFac
            AND fk_proceso = $intIdProce;
        	"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();
        
        $strPonde[][]=array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $strPonde[$i][0]=$recordSet->fields[0];
            $strPonde[$i][1]=$recordSet->fields[1];
            $strPonde[$i][2]=$recordSet->fields[2];
            $strPonde[$i][3]=$recordSet->fields[3];
            $strPonde[$i][4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $strPonde; 
    }
    
    //guarda la calificacion calculada de un factor
    function guardaCalFac($intIdFac, $floCal, $intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_factor_proceso SET calificacion = $floCal WHERE fk_factor = $intIdFac AND fk_proceso = $intIdProce;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();       
        
    }  
    
    //guarda la calificacion de una caracteristica
    function guardaCalCarac($intIdCar, $floCal, $intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $cadena = "UPDATE plm_caracteristica_proceso SET calificacion = $floCal WHERE fk_caracteristica = $intIdCar AND fk_proceso = $intIdProce;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();       
        
    }
    
    //guarda el analisis de una característica fortalezas, debilidades y analisi causal
    function guardaAnalisisCarac($intIdCar,$intIdFac, $strAnalisis, $strForta, $strDevi, $intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        
        $strForta = utf8_decode($strForta);
        $strDevi=utf8_decode($strDevi);
        $strAnalisis = utf8_decode($strAnalisis);
        $cadena = "UPDATE plm_caracteristica_proceso SET fortaleza = '$strForta', debilidad= '$strDevi',analisis ='$strAnalisis'
         WHERE fk_caracteristica = $intIdCar AND fk_factor = $intIdFac AND fk_proceso = $intIdProce;"; 
        
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();       
        
    }
    
	//busca la calificación de un factor en la base d edatos plm.
    function buscaCalFac($intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        $cadena = "SELECT A.nombre, B.calificacion 
                    FROM cna_factor A, plm_factor_proceso B 
                    WHERE A.pk_factor = B.fk_factor AND B.fk_proceso = $intIdProce;";
              
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();   
        
        
        $arrFactor[][]=array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $arrFactor[$i][0]=$recordSet->fields[0];
            $arrFactor[$i][1]=$recordSet->fields[1];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $arrFactor;         
    }
    
	//busca la calificación de las caracteristicas de un factor en la base plm.
    function buscaCalCarac($intIdFactor,$intIdProce)
    {
        global $conexion;
        $conexion->conectarAdo();
        $cadena = "SELECT A.nombre, B.calificacion 
                    FROM cna_caracteristica A, plm_caracteristica_proceso B 
                    WHERE A.pk_caracteristica = B.fk_caracteristica AND B.fk_proceso = $intIdProce AND
                    A.fk_factor = $intIdFactor AND A.fk_factor = B.fk_factor ;";
              
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();   
        
        
        $arrFactor[][]=array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $arrFactor[$i][0]=$recordSet->fields[0];
            $arrFactor[$i][1]=$recordSet->fields[1];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $arrFactor;         
    } 
    
    //busca las escalas guardadas 
    function mostrarEscala()
    {
        global $conexion;
        $conexion->conectarAdo();
        $cadena = "SELECT *
                    FROM plm_escala_cualitativa
                    WHERE estado = 1;";
              
        $recordSet = $conexion->Ejecutar($cadena);
        
        $conexion->Close();   
        
        
        $arrEsca[][]=array();
        $i=0;
        while(!$recordSet->EOF)
        {        
            $arrEsca[$i][0]=$recordSet->fields[0];
            $arrEsca[$i][1]=$recordSet->fields[1];
            $arrEsca[$i][2]=$recordSet->fields[2];
            $arrEsca[$i][3]=$recordSet->fields[3];
            $arrEsca[$i][4]=$recordSet->fields[4];
            $recordSet->MoveNext();
            $i++;
        }       
        
        return $arrEsca;  
    }
}
?>
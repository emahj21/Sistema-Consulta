<?php
require ("conexion.php");
function pedidosEntregado($f1,$f2,$conexion,$area){
    //------------ Consultas ------------
    $query="SELECT FechaEmp,PeFeReqCli FROM upedido WHERE FechaEmp BETWEEN '$f1' AND '$f2' ";
    $queryPuntosPedidos = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId='$area' AND configuracionindindicadores.Indicador='Pedidos entregados';";
    
    $resultado=$conexion->query($query);
    $resultado2=$conexion->query($queryPuntosPedidos);
    echo $query.'<br>';
    //------------ Variables ------------
    $totalPedidos=0;
    $pedidosBuenos=0;
    $pedidosEntregados=0;
    $puntosP=0;

    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
    echo "Total de pedidos: ";
    echo $totalPedidos."<br>";
    //Recorrido Peso Puntos
    while ($row2 = $resultado2->fetch_assoc()) {
        $puntosP = intval($row2['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $puntosP.'<br>';
    //Recorrido Funcion
    while ($row = $resultado->fetch_assoc()) {
        $liberacion = strtotime($row['FechaEmp']);
        $cliente = strtotime($row['PeFeReqCli']);
        if ($liberacion <= $cliente) {
            $pedidosBuenos++;
        }
    }
    echo "Pedidos Entregados a tiempo: ";
    echo $pedidosBuenos.'<br>';

    $pedidosEntregados=($pedidosBuenos*$puntosP)/$totalPedidos;
    echo "Valor Total: ";
    echo $pedidosEntregados;
    //return $pedidosEntregados;
}
function reclamos($conexion,$f1,$f2,$area){
    //----------- Consultas -----------
    $queryReclamo = "SELECT reclamacion,FechaRegistro  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2';";
    $queryPuntosReclamo = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId='$area' AND configuracionindindicadores.IndId=4;";
    $resultado = $conexion->query($queryReclamo);
    $resultado2 = $conexion->query($queryPuntosReclamo);
    echo $queryReclamo.'<br>';
    //----------- Variables -----------
    $totalR = 0;
    //Recorrido Puntos
    while ($row2 = $resultado2->fetch_assoc()) {
        $puntosR = intval($row2['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $puntosR.'<br>';
    //Recorrido Reclamos
    while ($row = $resultado->fetch_assoc()) {
        if ($row['reclamacion'] != 0) {
            $totalR++;
        }
    }
    echo "Total Reclamos: ";
    echo $totalR.'<br>';
    if ($totalR == 0) {
        $totalR = $puntosR;
    } else {
        //Valor total de reclamos
        if ($totalR * 5 > $puntosR) {
            $puntosR = 0;
        } else {
            $totalR = $puntosR - ($totalR * 5);
        }
    }
    echo "Valor Final: ";
    echo $totalR."<br>";
    //return $totalR;
}
function oc($conexion, $f1, $f2, $ind, $ind2){
    //---------- Consultas ----------
    $query = "SELECT FechaOCprog, FechaOCReal FROM uordencompra WHERE FechaOCprog BETWEEN  '$f1' AND '$f2'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 
    echo $query.'<br>';
    
    $resultado = $conexion->query($query);
    $result = $conexion->query($peso);
    //---------- Variables ----------
    $contador = 0;

    echo "Total de pedidos: ";
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);
    }
    echo $totalPedidos."<br>";
    //Recorrido Puntos
    echo "Total de puntos: ";
    while($row2 = $result->fetch_assoc()){
        $peso = intval($row2['PesoPuntos']);
    }
    echo $peso.'<br>';
    //Recorrido Funcion
    while($row = $resultado->fetch_assoc()){
        if($row['FechaOCReal'] == '1000-01-01'){
            $fechaActual = date('d-m-Y');
            $row['FechaOCReal'] = $fechaActual;
            
            if($row['FechaOCReal'] <= $row['FechaOCprog']){
                $contador++;
            }
        }else{
            if($row['FechaOCReal'] <= $row['FechaOCprog']){
                $contador++;
            }
        }
    }
    echo 'Pedidos buenos '.$contador.'<br>';
    $varfin = ($contador*$peso)/$totalPedidos;
    echo 'Valor final: '.$varfin;
    //return $varfin;
}
/* function dias($conexion,$FechaI,$FechaF,$f1,$f2,$tabla,$tabla2,$proc,$ind,$ind2){
    //---------- Consultas ----------
    if($tabla2==null){
        $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    }else{
        //$query = "SELECT ".$tabla.".".$FechaI.", ".$tabla2.".".$FechaF.", DATEDIFF(".$tabla2.".".$FechaF.", ".$tabla.".".$FechaI.") from ".$tabla.",".$tabla2." WHERE ".$tabla.".".$FechaI." BETWEEN '$f1' AND '$f2'";
        $query = "SELECT ".$tabla.".".$FechaI.", ".$tabla2.".".$FechaF.", DATEDIFF(".$tabla2.".".$FechaF.", ".$tabla.".".$FechaI. ")FROM ".$tabla." INNER JOIN ".$tabla2." ON ".$tabla.".Idpedido = ".$tabla2.".Idpedido WHERE ".$tabla.".".$FechaI." BETWEEN '$f1' AND '$f2';";
    }
    $festivo = "SELECT DFFecha from diasfest";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 
    echo $query.'<br>';
    echo $festivo.'<br>';
    echo $dia.'<br>';
    $resultado = $conexion->query($query);
    $resultado1 = $conexion->query($festivo);
    $resultado2 = $conexion->query($dia);
    $resultadoPeso = $conexion->query($peso);

    //---------- Variables ----------
    $contador_dias = 0;
    $a_tiempo=0;
    $diaFestivo=[];
    $integer2=0;
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
    echo "Total de pedidos: ";
    echo $totalPedidos."<br>";
    //Recorrido total días
    while($row2=$resultado2->fetch_assoc()){  
        $val = intval($row2['Diastotal']);
    }
    echo "Dias que tarda el proceso: ";
    echo $val."<br>";
    //Recorrido Puntos
    while($row3 = $resultadoPeso->fetch_assoc()){
        $peso = intval($row3['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $peso.'<br>';
    //Recorrido Fechas
    while($row1=$resultado1->fetch_assoc()){
        array_push($diaFestivo,$row1['DFFecha']);
    }
    //Recorrido Funcion
    while($row=$resultado->fetch_assoc()){
        if($tabla2==null){
            if($row[$FechaF]==='1000-01-01'  ){
                $date1 = new DateTime(date("Y-m-d"));
                $date2 = new DateTime($row[$FechaI]);
                $integer2 = date_diff($date1,$date2);
                var_dump($integer2->days);
            } 
            $integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);
        }else{
            /* if($row[$FechaF]=='1000-01-01'  ){

            } 
            //$integer2 = intval($row['DATEDIFF('.$tabla2.'.'.$FechaF.', '.$tabla.'.'.$FechaI.')']);
        }
       echo $integer2;
        for($i=0; $i<$integer2; $i++){    
            echo $row[$FechaI].'<br>';
            if( ($row[$FechaI] != $diaFestivo[$i])){   
                $aux = date("Y-m-d",strtotime($row[$FechaI]."+ 1 days"));
                echo $aux.'<br>';
                $row[$FechaI] = $aux;
                
                if(date("w",strtotime($row[$FechaI])) != 0){
                    $contador_dias++;
                    echo 'Día: '.$contador_dias.'<br>';
                }       
            }else{
                $aux = date("Y-m-d",strtotime($row[$FechaI]."+ 1 days"));
                $row[$FechaI] = $aux;
            }
        }
        
        if($contador_dias <= $val){
            $a_tiempo++;
            echo 'Pedido a tiempo: '.$a_tiempo.'<br>';
        }  
        $contador_dias = 0;
    }
    echo 'Pedidos a tiempo: ';
    echo $a_tiempo.'<br>';
    $val_final = ($a_tiempo*$peso)/$totalPedidos;
    echo 'Valor final: ';
    echo $val_final;
    //return $val_final;
} */
function dias($conexion,$FechaI,$FechaF,$f1,$f2,$tabla,$tabla2,$proc,$ind,$ind2){
    //---------- Consultas ----------
    if($tabla2==null){
        $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    }else{
        /* $query = "SELECT ".$tabla.".".$FechaI.", ".$tabla2.".".$FechaF.", DATEDIFF(".$tabla2.".".$FechaF.", ".$tabla.".".$FechaI.") from ".$tabla.",".$tabla2." WHERE ".$tabla.".".$FechaI." BETWEEN '$f1' AND '$f2'"; */
        $query = "SELECT ".$tabla.".".$FechaI.", ".$tabla2.".".$FechaF.", DATEDIFF(".$tabla2.".".$FechaF.", ".$tabla.".".$FechaI. ")FROM ".$tabla." INNER JOIN ".$tabla2." ON ".$tabla.".Idpedido = ".$tabla2.".Idpedido WHERE ".$tabla.".".$FechaI." BETWEEN '$f1' AND '$f2';";
    }
    $festivo = "SELECT DFFecha from diasfest";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 
    echo $query.'<br>';
    echo $festivo.'<br>';
    echo $dia.'<br>';
    $resultado = $conexion->query($query);
    $resultado1 = $conexion->query($festivo);
    $resultado2 = $conexion->query($dia);
    $resultadoPeso = $conexion->query($peso);

    //---------- Variables ----------
    $contador_dias = 0;
    $a_tiempo=0;
    $integer2 = 0;
    //$diaFestivo=[];
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
    echo "Total de pedidos: ";
    echo $totalPedidos."<br>";
    //Recorrido total días
    while($row2=$resultado2->fetch_assoc()){  
        $val = intval($row2['Diastotal']);
    }
    echo "Dias que tarda el proceso: ";
    echo $val."<br>";
    //Recorrido Puntos
    while($row3 = $resultadoPeso->fetch_assoc()){
        $peso = intval($row3['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $peso.'<br>';
    //Recorrido Fechas
    while($row1=$resultado1->fetch_assoc()){
        //array_push($diaFestivo,$row1['DFFecha']);
        while($row=$resultado->fetch_assoc()){
            if($tabla2==null){
                if($row[$FechaF] == '1000-01-01'){
                    $aux = date('d-m-Y');
                    $row[$FechaF] = $aux;
                    
                    $date1 = new DateTime($row[$FechaI]);
                    $date2 = new DateTime($row[$FechaF]);
                    $diff = $date1->diff($date2);
                    
                    $integer2 = intval($diff->days);
                }else{
                    $integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);
                }
            }else{
                $integer2 = intval($row['DATEDIFF('.$tabla2.'.'.$FechaF.', '.$tabla.'.'.$FechaI.')']);
      
            }
            for($i=0; $i<$integer2; $i++){    
                if( ($row[$FechaI] != $row1['DFFecha'])){   
                    $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                    $row[$FechaI] = $aux;
                    
                    if(date("w",strtotime($row[$FechaI])) != 0){
                        $contador_dias++;
                    }       
                }else{
                    $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                    $row[$FechaI] = $aux;
                }
                if($contador_dias <= $val){
                    $a_tiempo++;
                    //$cadena[$i] = '<h5>&#x2714;</h5>';
                    //echo $cadena[$i].'<br>';
                }else{
                    //$cadena[$i] = '<h5>&#10060;</h5>'; 
                    //echo $cadena[$i].'<br>';
                }
            }
            
            if($contador_dias <= $val){
                $a_tiempo++;
            }
            
               
                $contador_dias = 0;
            }
        

    }    
    echo 'Pedidos a tiempo: ';
    $val_final = ($a_tiempo*$peso)/$totalPedidos;
    echo $a_tiempo.'<br>';
    echo 'Valor final: ';
    echo $val_final;
    //return $val_final;

    //return $cadena;
} 

function recoleccion($conexion,$f1,$f2){
    //---------- Consultas ----------
    $query = "SELECT FechaOCReal, IdTipoOC, FechaVoBo, FechaEnvioMaq, DATEDIFF(FechaVoBo, FechaOCReal), DATEDIFF(FechaEnvioMaq, FechaOCReal) FROM uordencompra WHERE FechaOCReal BETWEEN '$f1' AND '$f2'";
    $festivo = "SELECT DFFecha from diasfest";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='Alm'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '7' AND IndId='3';"; 
    echo $query.'<br>';
    echo $festivo.'<br>';
    echo $dia.'<br>';
    //---------- Variables ----------
    $resultado = $conexion->query($query);
    $resultado1 = $conexion->query($festivo);
    $resultado2 = $conexion->query($dia);
    $resultadoPeso = $conexion->query($peso);
    $contador_dias=0;
    $a_tiempo=0;
    //Recorrido pedidos
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
    echo "Total de pedidos: ";
    echo $totalPedidos."<br>";
    //Recorrido total días
    while($row2=$resultado2->fetch_assoc()){  
        $val = intval($row2['Diastotal']);
    }
    echo "Dias que tarda el proceso: ";
    echo $val."<br>";
    //Recorrido puntos
    while($row3 = $resultadoPeso->fetch_assoc()){
        $peso = intval($row3['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $peso.'<br>';
    //Recorrido principal
    while($row1=$resultado1->fetch_assoc()){

        while($row=$resultado->fetch_assoc()){  

            if($row['IdTipoOC']==='2' || $row['IdTipoOC']==='3' || $row['IdTipoOC']==='10'){
                if($row['FechaVoBo']==='1000-01-01'){
                    $aux = date('d-m-Y');
                    $row['FechaVoBo'] = $aux;        
                    $date1 = new DateTime($row['FechaOCReal']);
                    $date2 = new DateTime($row['FechaVoBo']);
                    $diff = $date1->diff($date2);
                    $integer2 = intval($diff->days);
                }else{
                    $integer2=intval($row["DATEDIFF(FechaVoBo, FechaOCReal)"]);
                }
            }else{
                if($row['FechaEnvioMaq']==='1000-01-01'){
                    $aux = date('d-m-Y');
                    $row['FechaEnvioMaq'] = $aux;        
                    $date1 = new DateTime($row['FechaOCReal']);
                    $date2 = new DateTime($row['FechaEnvioMaq']);
                    $diff = $date1->diff($date2);
                    $integer2 = intval($diff->days);
                }else{
                    $integer2=intval($row["DATEDIFF(FechaEnvioMaq, FechaOCReal)"]);
                }
            }
            for($i=0;$i<$integer2;$i++){
                if( ($row['FechaOCReal'] != $row1['DFFecha'])){   
                    $aux = date("d-m-Y",strtotime($row['FechaOCReal']."+ 1 days"));
                    $row['FechaOCReal'] = $aux;
                    
                    if(date("w",strtotime($row['FechaOCReal'])) != 0){
                        $contador_dias++;
                    }       
                }else{
                    $aux = date("d-m-Y",strtotime($row['FechaOCReal']."+ 1 days"));
                    $row['FechaOCReal'] = $aux;
                }
            }
            if($contador_dias <= $val){
                $a_tiempo++;
            }  
            $contador_dias = 0;
        }

    }
    echo 'Pedidos a tiempo: ';
    $val_final = ($a_tiempo*$peso)/$totalPedidos;
    echo $a_tiempo.'<br>';
    echo 'Valor final: ';
    echo $val_final;
    //return $val_final;
}
function rechazos($conexion, $f1, $f2){
    //---------- Consultas ----------
    $query="SELECT FechaAdmin, NoRechazoImg, NoRechazoCom, NoRechazoAdm FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2';";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='Admin'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '6' AND IndId='3';"; 
    echo $query.'<br>';
    echo $dia.'<br>';
    echo $peso.'<br>';
    //---------- Variables ----------
    $resultado = $conexion->query($query);
    $resultado2 = $conexion->query($dia);
    $resultadoPeso = $conexion->query($peso);
    $cont_rechazos=0;
    //Recorrido Pedidos
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
    echo "Total de pedidos: ";
    echo $totalPedidos."<br>";
    //Recorrido días
    while($row2=$resultado2->fetch_assoc()){  
        $val = intval($row2['Diastotal']);
    }
    echo "Dias que tarda el proceso: ";
    echo $val."<br>";
    //Recorrido puntos
    while($row3 = $resultadoPeso->fetch_assoc()){
        $peso = intval($row3['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $peso.'<br>';
    while($row = $resultado->fetch_assoc()){
        if($row['NoRechazoAdm']!=0 || $row['NoRechazoCom']!=0 ||$row['NoRechazoImg']!=0){
            $cont_rechazos++;
        }
    }
    $buenos=$totalPedidos-$cont_rechazos;
    echo "Numero de Rechazos: ";
    echo $cont_rechazos.'<br>';
    $val_Total=($buenos*$peso)/$totalPedidos;
    echo "Valor final: ";
    echo $val_Total.'<br>';
    //return $val_Total;
}
function defectos($conexion, $f1, $f2, $proc, $ind, $ind2){
    //---------- Consultas ----------
    $query = "SELECT OCDefDev, OCDefAcep FROM uordencompra WHERE FechaVoBo BETWEEN '$f1' AND '$f2' ";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 
    echo $query.'<br>';
    echo $dia.'<br>';
    echo $peso.'<br>';
    //---------- Variables ----------
    $resultado = $conexion->query($query);
    $resultado2 = $conexion->query($dia);
    $resultadoPeso = $conexion->query($peso);
    $defectos = 0;
    //$buenos;
    $totalPedidos = 0;
    $valTotal = 0;
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
    echo "Total de pedidos: ";
    echo $totalPedidos."<br>";
    while($row2=$resultado2->fetch_assoc()){  
        $val = intval($row2['Diastotal']);
    }
    echo "Dias que tarda el proceso: ";
    echo $val."<br>";
    while($row3 = $resultadoPeso->fetch_assoc()){
        $peso = intval($row3['PesoPuntos']);
    }
    echo "Peso Puntos: ";
    echo $peso.'<br>';
    while($row = $resultado->fetch_assoc()){
        if($row['OCDefDev']!=0 || $row['OCDefAcep']!=0){
            $defectos++;
        }
    }
    
    $buenos = $totalPedidos - $defectos;
    $valTotal = ($buenos*$peso)/$totalPedidos;
    echo 'Valor final: ';
    echo $valTotal;
    //return $valTotal;
}

$f1='2021-12-01';
$f2='2021-12-15';

echo "<h1> ADMINISTARCIÓN </h1>";
echo "<h2> Indicador 1.1 Revisión de Antivipos y Facturas</h2>";
 //var_dump(dias($conexion,'FechaRegistro','FechaAdmin',$f1,$f2,'upedido',null,'Admin','1','1'));
dias($conexion,'FechaRegistro','FechaAdmin',$f1,$f2,'upedido',null,'Admin','1','1');
echo "<h2> Indicador 1.2 Liberación</h2>";
dias($conexion,'FechaEmp','FechaLiberacion',$f1,$f2,'upedido',null,'Admin','1','2');
echo "<h2> Indicador 1.4 Reclamanciones</h2>";
reclamos($conexion,$f1,$f2,"1");
echo "<h2> Indicador 1.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,1);
echo "<h1> COMPRAS </h1>";
echo "<h2> Indicador 2.1 Generación de OC's(PENDIENTE)</h2>";
//oc($conexion,$f1,$f2,'2','1');
dias($conexion,'FechaRegOC','FechaAdmin',$f1,$f2,'uordencompra','upedido','Comp','2','1');
echo "<h2> Indicador 2.2 Recepción de OC's</h2>";
oc($conexion,$f1,$f2,'2','2');
echo "<h2> Indicador 2.4 Reclamos</h2>";
reclamos($conexion,$f1,$f2,"2");
echo "<h2> Indicador 2.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,2);
echo "<h1> LOGÍSTICA </h1>";
echo "<h2> Indicador 3.1 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,3);
echo "<h1> IMAGEN </h1>";
echo "<h2> Indicador 4.1 Generación de Fichas</h2>";
dias($conexion,'SDeFeSol','SDeFeEnvio',$f1,$f2,'solicituddetalle',null,'IC','4','1');
echo "<h2> Indicador 4.2 Autorización de Fichas(PENDIENTE)</h2>";

echo "<h2> Indicador 4.3 Personalización</h2>";
dias($conexion,'PerEnvioPrendas','PerDateR',$f1,$f2,'upersonalizacion',null,'Procesos','4','3');
echo "<h2> Indicador 4.4 Reclamaciones</h2>";
reclamos($conexion,$f1,$f2,"4");
echo "<h2> Indicador 4.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,4);
echo "<h1> EMPAQUE </h1>";
echo "<h2> Indicador 5.1 Empaque</h2>";
dias($conexion,'FechaEmpR','FechaProcesos',$f1,$f2,'uempaque','upedido','Emp','5','1');
echo "<h2> Indicador 5.4 Reclamaciones</h2>";
reclamos($conexion,$f1,$f2,"5");
echo "<h2> Indicador 5.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,5);
echo "<h1> BACKOFFICE </h1>";
echo "<h2> Indicador 6.1 Pedidos Registrados</h2>";
dias($conexion,'FechaEnvioBCK','FechaRegistro',$f1,$f2,'upedido',null,'Registro-Backoffice','6','1');
echo "<h2> Indicador 6.3 Regreso a Asesores</h2>";
rechazos($conexion,$f1,$f2);
echo "<h2> Indicador 6.4 Reclamaciones</h2>";
reclamos($conexion,$f1,$f2,"6");
echo "<h2> Indicador 6.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,6);
echo "<h1> ALMACEN </h1>";
echo "<h2> Indicador 7.1 Revisiones</h2>";
dias($conexion,'FechaOCReal','OC1aRevFe',$f1,$f2,'uordencompra',null,'Rev1','7','1');
echo "<h2> Indicador 7.2 Recepción de OC's</h2>";
dias($conexion,'FechaOCReal','OC2aRevFe',$f1,$f2,'uordencompra',null,'Rev2','7','2');
echo "<h2> Indicador 7.3 Recolección</h2>";
recoleccion($conexion, $f1,$f2);
echo "<h2> Indicador 7.4 Reclamaciones</h2>";
reclamos($conexion,$f1,$f2,"7");
echo "<h2> Indicador 7.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,7);
echo "<h1> CALIDAD </h1>";
echo "<h2> Indicador 8.1 Revisión de Maquilas 1</h2>";
dias($conexion,'FechaOCReal','OC1aRevFe',$f1,$f2,'uordencompra',null,'Rev1','8','1');
echo "<h2> Indicador 8.2 Revisión de Maquilas 2</h2>";
dias($conexion,'FechaOCReal','OC2aRevFe',$f1,$f2,'uordencompra',null,'Rev2','8','2');
echo "<h2> Indicador 8.3 Defectos de Calidad</h2>";
defectos($conexion, $f1, $f2, 'Procesos', '8', '3');
echo "<h2> Indicador 8.4 Reclamaciones</h2>";
reclamos($conexion,$f1,$f2,"8");
echo "<h2> Indicador 8.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,8);
echo "<h1> PRODUCCIÓN </h1>";
echo "<h2> Indicador 11.1 Generación de OC's</h2>";
oc($conexion,$f1,$f2,'11','1');
echo "<h2> Indicador 11.2 Recepción de OC's</h2>";
oc($conexion,$f1,$f2,'11','2');
echo "<h2> Indicador 11.4 Reclamaciones</h2>";
reclamos($conexion,$f1,$f2,"11");
echo "<h2> Indicador 11.5 Pedidos Entregados</h2>";
pedidosEntregado($f1,$f2,$conexion,11);

<?php
require ("conexion.php");
#require ("pag/consulta.php");

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

/* echo "<h1> ADMINISTARCIÓN </h1>";
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
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js" integrity="sha512-uLlukEfSLB7gWRBvzpDnLGvzNUluF19IDEdUoyGAtaO0MVSBsQ+g3qhLRL3GTVoEzKpc24rVT6X1Pr5fmsShBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <title>Document</title>

    <style>
        .tabla{
            border-color: salmon;
            border-radius: 5px;
        }
        #tabla,#tabla1,#tabla2,#tabla3{
            display: none;
        }
    </style>
</head>
<body>
    <div>
        <h1> ADMINISTARCIÓN </h1>
        <div style="width: 400px;">
            <canvas id="graficaAdmi1" width="400" height="400"></canvas>
            
        </div>
        <div>
            <h2> 1.1 Revisión de Anticipos y Facturas</h2>
            <?php  dias($conexion,'FechaRegistro','FechaAdmin',$f1,$f2,'upedido',null,'Admin','1','1');?>
            <div>
                <button type="button" onclick="mostrarAdmi1();">Revisión de Anticipos y Facturas</button>
                <div id="tabla">
                    <table class="tabla" border="2">
                        <thead class="thead-dark">
                            <tr>
                                <td>Nombre del Cliente</td>
                                <td>Número de Pedido</td>
                                <td>Fecha de Inicio</td>
                                <td>Fecha De Término</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT upedido.Idpedido, upedido.FechaRegistro, upedido.FechaAdmin, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                                        INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                                        INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                                        WHERE FechaRegistro BETWEEN '$f1' AND '$f2'";
                            $resultado = $conexion->query($query);
                            $i = 0;
                            while ($row = $resultado->fetch_assoc()) {?>
                                <tr>
                                    <td><?php echo $row['CRazonSocial'] ?></td>
                                    <td><?php echo $row['Idpedido'] ?></td>
                                    <td><?php echo $row['FechaRegistro'] ?></td>
                                    <td><?php echo $row['FechaAdmin'] ?></td>
                                </tr> 
                            <?php }?> 
                        </tbody>
                    </table>
                    <button type="button" onclick="ocultarAdmi1();">Ocultar Tabla</button>
                </div>
            </div><!-- Tabla Admi1 -->
        </div>

        <div>
            <h2> 1.2 Liberación</h2>
            <?php dias($conexion,'FechaEmp','FechaLiberacion',$f1,$f2,'upedido',null,'Admin','1','2');?>
            <div>
                <button type="button" onclick="mostrarAdmi2();">Liberación</button>
                <div id="tabla1">
                    <table class="tabla" border="2">
                        <thead  class="thead-dark">
                            <tr>
                                <td>Nombre del Cliente</td>
                                <td>Número de Pedido</td>
                                <td>Fecha de Empaque</td>
                                <td>Fecha de Liberación</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT upedido.Idpedido, upedido.FechaEmp, upedido.FechaLiberacion, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                                INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                                INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                                WHERE FechaEmp BETWEEN '$f1' AND '$f2'";
        
                                $resultado= $conexion->query($query);
                                $i=0;
                                while($row=$resultado->fetch_assoc()){
                                    if($row['FechaLiberacion'] == '1000-01-01 00:00:00'){
                                        $row['FechaLiberacion'] = date('Y-m-d');
                                    }
                            ?>
                            <tr>
                                <td><?php echo $row['CRazonSocial'] ?></td>
                                <td><?php echo $row['Idpedido'] ?></td> 
                                <td><?php echo $row['FechaEmp'] ?></td> 
                                <td><?php echo $row['FechaLiberacion'] ?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button type="button" onclick="ocultarAdmi2();">Ocultar Tabla</button>
                </div>
            </div><!-- Tabla Admi2 -->
        </div>


    </div>
    
    <h2> 1.4 Reclamanciones</h2>
    <?php reclamos($conexion,$f1,$f2,"1");?>
    <h2> 1.5 Pedidos Entregados</h2>
    <?php pedidosEntregado($f1,$f2,$conexion,1);?>
    
    <div>
        <div>
            <button type="button" onclick="mostrarTabla2();">Revisión de Anticipos y Facturas</button>
            <button type="button" onclick="mostrarTabla3();">Liberación</button>
        </div>
        <div id="tabla2">
            <table class="tabla" border="2">
                <thead class="thead-dark">
                    <tr>
                        <td>Nombre del Cliente</td>
                        <td>Número de Pedido</td>
                        <td>Fecha de Inicio</td>
                        <td>Fecha De Término</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT upedido.Idpedido, upedido.FechaRegistro, upedido.FechaAdmin, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                                INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                                INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                                WHERE FechaRegistro BETWEEN '$f1' AND '$f2'";
                    $resultado = $conexion->query($query);
                    $i = 0;
                    while ($row = $resultado->fetch_assoc()) {?>
                        <tr>
                            <td><?php echo $row['CRazonSocial'] ?></td>
                            <td><?php echo $row['Idpedido'] ?></td>
                            <td><?php echo $row['FechaRegistro'] ?></td>
                            <td><?php echo $row['FechaAdmin'] ?></td>
                        </tr> 
                    <?php }?> 
                </tbody>
            </table>
            <button type="button" onclick="ocultarTabla2();">Ocultar Tabla</button>
        </div>
        
        <div id="tabla3">
            <table class="tabla" border="2">
                <thead  class="thead-dark">
                    <tr>
                        <td>Nombre del Cliente</td>
                        <td>Número de Pedido</td>
                        <td>Fecha de Empaque</td>
                        <td>Fecha de Liberación</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT upedido.Idpedido, upedido.FechaEmp, upedido.FechaLiberacion, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                        INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                        INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                        WHERE FechaEmp BETWEEN '$f1' AND '$f2'";

                        $resultado= $conexion->query($query);
                        $i=0;
                        while($row=$resultado->fetch_assoc()){
                            if($row['FechaLiberacion'] == '1000-01-01 00:00:00'){
                                $row['FechaLiberacion'] = date('Y-m-d');
                            }
                    ?>
                    <tr>
                        <td><?php echo $row['CRazonSocial'] ?></td>
                        <td><?php echo $row['Idpedido'] ?></td> 
                        <td><?php echo $row['FechaEmp'] ?></td> 
                        <td><?php echo $row['FechaLiberacion'] ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <button type="button" onclick="ocultarTabla3();">Ocultar Tabla</button>
        </div>
    </div>

    <script>
        function mostrarAdmi1(){
            document.getElementById('tabla').style.display='block';
            document.getElementById('tabla1').style.display='none';
        }
        function mostrarAdmi2(){
            document.getElementById('tabla1').style.display='block';
            document.getElementById('tabla').style.display='none';
        }
        function mostrarTabla2(){
            document.getElementById('tabla2').style.display='block';
            document.getElementById('tabla3').style.display='none';
        }
        function mostrarTabla3(){
            document.getElementById('tabla3').style.display='block';
            document.getElementById('tabla2').style.display='none';
        }
        function ocultarAdmi1(){
            document.getElementById('tabla').style.display='none';
        }
        function ocultarAdmi2(){
            document.getElementById('tabla1').style.display='none';
        }
        function ocultarTabla2(){
            document.getElementById('tabla2').style.display='none';
        }
        function ocultarTabla3(){
            document.getElementById('tabla3').style.display='none';
        }
        

    </script>
    
    <!-- <canvas id="myChart" width="400" height="400"></canvas> -->
    <script>
        var ctx = document.getElementById('graficaAdmi1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: '# of Votes',
                    data: [5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>



</html>
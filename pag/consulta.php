<?php 
echo '<h1 align="center"> Indicadores </h1>';
  include("../conexion.php");

  $f1 = $_POST['Fein'];
  $f2 = $_POST['Fefin'];


  $queryAreas="SELECT Area FROM configuracionind";
  $consultaAreas=mysqli_query($conexion,$queryAreas);
  $tabla_areas=[];
  $i=0;  
  $puntos = 100;
  $nuevo=0;
  while($row = mysqli_fetch_array($consultaAreas)){
        $tabla_areas[$i]['nombre']=$row['Area'];
        $i++;
  }
//echo 'Prom '.$RAF;

//----------Funcion para consulta de Reclamos----------
function reclamos($f1, $f2, $conexion, $area)
{
  $totalR = 0;
  $puntosR = 0;
  $puntos = 100;
  //Consultas Reclamo
  $queryReclamo = "SELECT reclamacion,FechaRegistro  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2' ;
  ";
  $queryPuntosReclamo = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId='$area' AND configuracionindindicadores.IndId=4;";

  $resultado = $conexion->query($queryReclamo);
  $resultado2 = $conexion->query($queryPuntosReclamo);

  //Recorrido de consultas
  while ($row2 = $resultado2->fetch_assoc()) {
    $puntosR = intval($row2['PesoPuntos']);
  }

  while ($row = $resultado->fetch_assoc()) {

    if ($row['reclamacion'] != 0) {
      $totalR++;
    }
    //Valor total de reclamos


  }
 

  if ($totalR == 0) {
    $totalR = $puntosR;
  }else
  {
    $nuevo = $puntos - ($totalR * 30);
    if($totalR >= 4)
    {
       $totalR = 0;
    }
    else
    {
      $totalR = ($nuevo*$puntosR)/$puntos;
    }
  }
   
  
  return $totalR;
}

function pedidosEntregado($f1,$f2,$conexion,$area){

  $totalPedidos=0;
  $pedidosBuenos=0;
  $pedidosEntregados=0;
  $puntosP=0;

  $query="SELECT FechaEmp,PeFeReqCli FROM upedido WHERE FechaEmp BETWEEN '$f1' AND '$f2' ";
  $queryPuntosPedidos = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId='$area' AND configuracionindindicadores.Indicador='Pedidos entregados';";

  $resultado=$conexion->query($query);
  $resultado2=$conexion->query($queryPuntosPedidos);

  if($resultado){
    $pedidos = intval($totalPedidos=mysqli_num_rows($resultado));  
    //echo intval($totalPedidos);
  }

  while ($row2 = $resultado2->fetch_assoc()) {
    $puntosP = intval($row2['PesoPuntos']);
  }

 
  while ($row = $resultado->fetch_assoc()) {
    $liberacion = strtotime($row['FechaEmp']);
    $cliente = strtotime($row['PeFeReqCli']);

    if ($liberacion <= $cliente) {
      $pedidosBuenos++;
    }
    else
    {
      
    }

    //echo intval($pedidosBuenos);
  
  }
  $pedidosEntregados=($pedidosBuenos*$puntosP)/$pedidos;
  return $pedidosEntregados;

  
}


function oc($conexion, $f1, $f2, $ind, $ind2)
{
    $query = "SELECT FechaOCprog, FechaOCReal FROM uordencompra WHERE FechaOCprog BETWEEN  '$f1' AND '$f2'";
    $resultado = $conexion->query($query);
    $contador = 0;

    /* Consultando peso */

    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 
    $result = $conexion->query($peso);

    while($row2 = $result->fetch_assoc())
    {
        $peso = intval($row2['PesoPuntos']);
        //echo $peso;
    }


    if($resultado)
    {
      $totalPedidos=mysqli_num_rows($resultado);
    }

    while($row = $resultado->fetch_assoc())
    {
        if($row['FechaOCReal'] == '1000-01-01')
        {
            $fechaActual = date('d-m-Y');
            $row['FechaOCReal'] = $fechaActual;

            if($row['FechaOCReal'] <= $row['FechaOCprog'])
            {
                $contador++;
            }
        }else
        {
            if($row['FechaOCReal'] <= $row['FechaOCprog'])
            {
                $contador++;
            }
        }

    }
    //echo 'Buenos '.$contador.'<br>';
    $varfin = ($contador*$peso)/$totalPedidos;
    return $varfin;
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

  $resultado = $conexion->query($query);
  $resultado1 = $conexion->query($festivo);
  $resultado2 = $conexion->query($dia);
  $resultadoPeso = $conexion->query($peso);

  //---------- Variables ----------
  $contador_dias = 0;
  $a_tiempo=0;
  $integer2 = 0;
  $diaFestivo=[];
  if($resultado){
      $totalPedidos=mysqli_num_rows($resultado);  
  }
  //Recorrido total días
  while($row2=$resultado2->fetch_assoc()){  
      $val = intval($row2['Diastotal']);
  }
  //Recorrido Puntos
  while($row3 = $resultadoPeso->fetch_assoc()){
      $peso = intval($row3['PesoPuntos']);
  }
  //Recorrido Fechas
  while($row1=$resultado1->fetch_assoc()){
      array_push($diaFestivo,$row1['DFFecha']);
      while($row=$resultado->fetch_assoc()){
          if($tabla2==null){
            if($row[$FechaF] == '1000-01-01 00:00:00' || $row[$FechaF] == '1000-01-01')
            {
               $aux = date('d-m-Y');
               $row[$FechaF] = $aux;
    
               $date1 = new DateTime($row[$FechaI]);
               $date2 = new DateTime($row[$FechaF]);
               $diff = $date1->diff($date2);
    
               $integer2 = intval($diff->days);
            }else
            {
    
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
              
          }
          
          if($contador_dias <= $val){
              $a_tiempo++;
          }  
          $contador_dias = 0;
      }
  }
  //Recorrido Funcion
  $val_final = ($a_tiempo*$peso)/$totalPedidos;
  return $val_final;
}







function defectos($conexion, $f1, $f2, $proc, $ind, $ind2)
{

  

  $query = "SELECT OCDefDev, OCDefAcep FROM uordencompra
  WHERE FechaVoBo BETWEEN '$f1' AND '$f2' ";

  $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
  $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 

  $resultado2 = $conexion->query($dia);
  $resultadoPeso = $conexion->query($peso);

  $resultado = $conexion->query($query);
  $defectos = 0;
  $buenos;
  $totalPedidos = 0;
  $valTotal = 0;

  while($row2=$resultado2->fetch_assoc()){  
    $val = intval($row2['Diastotal']);
  }

  while($row3 = $resultadoPeso->fetch_assoc()){
    $peso = intval($row3['PesoPuntos']);
  }

  if($resultado){
    $totalPedidos=mysqli_num_rows($resultado);  
  }
  
  while($row = $resultado->fetch_assoc())
  {
    
    if($row['OCDefDev']!=0 || $row['OCDefAcep']!=0)
    {
      $defectos++;
    }
  }
  $buenos = $totalPedidos - $defectos;
  $valTotal = ($buenos*$peso)/$totalPedidos;
  
  return $valTotal;


}

function recoleccion($conexion,$f1,$f2){
  $query = "SELECT FechaOCReal,IdTipoOC,FechaVoBo, FechaEnvioMaq, DATEDIFF(FechaVoBo, FechaOCReal), DATEDIFF(FechaEnvioMaq, FechaOCReal) FROM uordencompra WHERE FechaOCReal BETWEEN '$f1' AND '$f2'";
  $festivo = "SELECT DFFecha from diasfest";
  $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='Alm'";
  $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '7' AND IndId='3';"; 
  //echo $query.'<br>';
  //echo $festivo.'<br>';
  //echo $dia.'<br>';
  //
  $resultado = $conexion->query($query);
  $resultado1 = $conexion->query($festivo);
  $resultado2 = $conexion->query($dia);
  $resultadoPeso = $conexion->query($peso);
  $contador_dias=0;
  $a_tiempo=0;
  $totalPedidos;
  
  //
  if($resultado){
      $totalPedidos=mysqli_num_rows($resultado);  
  }
  //echo "Total de pedidos: ";
 // echo $totalPedidos."<br>";
  while($row2=$resultado2->fetch_assoc()){  
      $val = intval($row2['Diastotal']);
  }
  //echo "Dias que tarda el proceso: ";
  //echo $val."<br>";
  while($row3 = $resultadoPeso->fetch_assoc()){
      $peso = intval($row3['PesoPuntos']);
  }
  //echo "Peso Puntos: ";
  //echo $peso.'<br>';
  while($row1=$resultado1->fetch_assoc()){
  }

      while($row=$resultado->fetch_assoc()){  

          if($row['IdTipoOC']==='2' || $row['IdTipoOC']==='3' || $row['IdTipoOC']==='10'){
              if($row['FechaVoBo']==='1000-01-01'){
                  $aux = date('d-m-Y');
                  $row['FechaVobo'] = $aux;        
                  $date1 = new DateTime($row['FechaOCReal']);
                  $date2 = new DateTime($row['FechaVoBo']);
                  $diff = $date1->diff($date2);
                  $integer2 = intval($diff->days);
              }else{
                  $integer2=intval($row['DATEDIFF(FechaVoBo, FechaOCReal)']);
              }
          }else{
              if($row['FechaEnvioMaq']==='1000-01-01'){
                  $aux = date('d-m-Y');
                  $row['FechaVobo'] = $aux;        
                  $date1 = new DateTime($row['FechaOCReal']);
                  $date2 = new DateTime($row['FechaEnvioMaq']);
                  $diff = $date1->diff($date2);
                  $integer2 = intval($diff->days);
              }else{
                  $integer2=intval($row['DATEDIFF(FechaEnvioMaq, FechaOCReal)']);
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
  //echo 'Pedidos a tiempo: ';
  $val_final = ($a_tiempo*$peso)/$totalPedidos;
  //echo $a_tiempo.'<br>';
  //echo 'Valor final: ';
  //echo $val_final;
  return $val_final;


function rechazos($conexion, $f1, $f2){
  //---------- Consultas ----------
  $query="SELECT FechaAdmin, NoRechazoImg, NoRechazoCom, NoRechazoAdm FROM upedido WHERE FechaAdmin BETWEEN '$f1' AND '$f2';";
  $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='Admin'";
  $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '6' AND IndId='3';"; 
  //echo $query.'<br>';
  //echo $dia.'<br>';
  //echo $peso.'<br>';
  //---------- Variables ----------
  $resultado = $conexion->query($query);
  $resultado2 = $conexion->query($dia);
  $resultadoPeso = $conexion->query($peso);
  
  $cont_rechazos=0;
  if($resultado){
      $totalPedidos=mysqli_num_rows($resultado);  
  }
  //echo "Total de pedidos: ";
  //echo $totalPedidos."<br>";
  while($row2=$resultado2->fetch_assoc()){  
      $val = intval($row2['Diastotal']);
  }
  //echo "Dias que tarda el proceso: ";
  //echo $val."<br>";
  while($row3 = $resultadoPeso->fetch_assoc()){
      $peso = intval($row3['PesoPuntos']);
  }
  //echo "Peso Puntos: ";
  //echo $peso.'<br>';
  while($row = $resultado->fetch_assoc()){
      if($row['NoRechazoAdm']!=0 || $row['NoRechazoCom']!=0 ||$row['NoRechazoImg']!=0){
          $cont_rechazos++;
      }
  }
  $buenos=$totalPedidos-$cont_rechazos;
  //echo "Numero de Rechazos: ";
  //echo $cont_rechazos.'<br>';
  $val_Total=($buenos*$peso)/$totalPedidos;
  //echo "Valor final: ";
  //echo $val_Total.'<br>';

  return $val_Total;

}

?>

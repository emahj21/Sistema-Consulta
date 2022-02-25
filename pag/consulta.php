<?php 
echo '<h1 align="center"> Indicadores </h1>';
  include("../conexion.php");

  $f1 = $_POST['Fein'];
  $f2 = $_POST['Fefin'];


  $queryAreas="SELECT Area FROM configuracionind";
  $consultaAreas=mysqli_query($conexion,$queryAreas);
  $tabla_areas=[];
  $i=0;  
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
  }
    if (($totalR * 5) > $puntosR) {
      $puntosR = 0;
    } else {
      $totalR = $puntosR - ($totalR * 5);
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
    $totalPedidos=mysqli_num_rows($resultado);  
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

    //echo intval($pedidosBuenos);
  
  }
  $pedidosEntregados=($pedidosBuenos*$puntosP)/$totalPedidos;
  return $pedidosEntregados;

  
}



function dias($conexion,$FechaI,$FechaF,$f1,$f2, $tabla,$proc){
  //---------- Consultas ----------
  $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
  $festivo = "SELECT DFFecha from diasfest";
  $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
  
  $resultado = $conexion->query($query);
  $resultado1 = $conexion->query($festivo);
  $resultado2 = $conexion->query($dia);
  
  //---------- Variables ----------
  $aux;
  $contador_dias = 0;
  $a_tiempo=0;

  /* Total Pedidos */
  if($resultado){
      $totalPedidos=mysqli_num_rows($resultado);  
      //echo intval($totalPedidos);
  }
  while($row2=$resultado2->fetch_assoc())
  {  
    $val = intval($row2['Diastotal']);
  }
  while($row1=$resultado1->fetch_assoc()){
  }
  while($row=$resultado->fetch_assoc())
  {
      /* Si la fecha es default */
      $integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);

      for($i=0; $i<$integer2; $i++){    
          if( ($row[$FechaI] != $row1['DFFecha'])){   
              $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
              $row[$FechaI] = $aux;
              //echo " al ".date("d-m-Y",strtotime($row[$FechaI])).'<br>';
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
//echo $a_tiempo;
$val_final = ($a_tiempo*20)/$totalPedidos;

//echo $val_final;

return $val_final;


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

?>

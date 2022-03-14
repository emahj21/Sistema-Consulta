<?php

include("../conexion.php");

$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];

function reclamos($f1, $f2, $conexion, $area)
{
  $totalR = 0;
  $puntosR = 0;
  $reclamos = 0;
  //Consultas Reclamo
  $queryReclamo = "SELECT reclamacion,FechaRegistro  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'";
  $queryPuntosReclamo = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId='$area' AND configuracionindindicadores.IndId=4;";

  $resultado = $conexion->query($queryReclamo);
  $resultado2 = $conexion->query($queryPuntosReclamo);

  //Recorrido de consultas
  while ($row2 = $resultado2->fetch_assoc()) {
    $puntosR = intval($row2['PesoPuntos']);
  }

  while ($row = $resultado->fetch_assoc()) {

    if ($row['reclamacion'] != 0) {
      $reclamos ++;
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
  
  return $reclamos;
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
    $mensaje[]=array();
    while ($row2 = $resultado2->fetch_assoc()) {
      $puntosP = intval($row2['PesoPuntos']);
    }
  
   
    while ($row = $resultado->fetch_assoc()) {
      /* $liberacion = strtotime($row['FechaEmp']);
      $cliente = strtotime($row['PeFeReqCli']); */
  
      if ($row['FechaEmp'] <= $row['PeFeReqCli']) {
          $pedidosBuenos++;
        $mensaje = '<h5>&#x2714;</h5>';
          //echo $mensaje;
      }else
      {
          $mensaje = '<h5> &#10060; </h5>';
          //echo $mensaje;
      }

      if($mensaje ==  '<h5>&#x2714;</h5>')
      {
          return $bueno = $mensaje;
      }
      else
      {
          return $malo = '<h5>&#x2714;</h5>';
      }

  
      //echo intval($pedidosBuenos);
      //return $mensaje;
      //$mensaje = '';
    }
    
    $pedidosEntregados=($pedidosBuenos*$puntosP)/$totalPedidos;
    
  
    
  }


?>
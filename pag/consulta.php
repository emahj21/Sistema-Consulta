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

  /* Área Administración */
  $query = "SELECT FechaRegistro, FechaAdmin, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)";

  $query2 = "SELECT FechaEmp, FechaLiberacion, DAYOFWEEK(FechaEmp), DATEDIFF(FechaLiberacion, FechaEmp) from upedido WHERE FechaEmp BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaEmp) IN (2,3,4,5,6)";

  /* Compras */

  $query3 = "SELECT FechaRegistro, FechaAdmin, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)";

  /* Pedidos Entregados */

  $query4 = "SELECT FechaLiberacion, PeFeReqCli, DAYOFWEEK(FechaLiberacion) from upedido WHERE FechaLiberacion BETWEEN '$f1' AND '$f2' AND DAYOFWEEK(FechaLiberacion) IN (2,3,4,5,6)";

  $resultado = $conexion->query($query);
  $resultado1 = $conexion->query($query2);
  $pedido_ent = $conexion->query($query4);
    
  $tiempoad = 0;
  $no_tiempoad = 0;

  $tiempocom = 0;
  $no_tiempocom = 0;

  $pedidos = 0;

  //Contamos las filas RAF
  $cuentafila; 
  $cuentafila1;
  $cuentafila2;

  if($resultado)
  {
    $cuentafila = mysqli_num_rows($resultado);
    echo 'Total '.$cuentafila;
  }

  if($resultado1)
  {
    $cuentafila1 = mysqli_num_rows($resultado1);
    echo 'Total '.$cuentafila1;
  }

  if($pedido_ent)
  {
    $cuentafila2 = mysqli_num_rows($pedido_ent);
    echo 'Total '.$cuentafila2;
  }

  /* Convirtiendo fechas a entero */
  while($row2=$pedido_ent->fetch_assoc()){
    ?>
    <?php $integer2 = intval($row2['FechaLiberacion']);
          $integer3 = intval($row2['PeFeReqCli']);
    

    if($integer2 <=$integer3)
    {
        $pedidos++;
    }else
    {
        $no_tiempocom++;
    }
    ?>
    <?php
}

$PEA = ($pedidos*30)/$cuentafila2;


?>
<?php

  while($row1=$resultado1->fetch_assoc()){
      ?>
      <?php $integer2 = intval($row1['DATEDIFF(FechaLiberacion, FechaEmp)']);

      if($integer2 <=1)
      {
          $tiempocom++;
      }else
      {
          $no_tiempocom++;
      }
      ?>
      <?php
  }

  $LIB = ($tiempocom*20)/$cuentafila1;

  
  ?>
<?php   

  while($row=$resultado->fetch_assoc()){
      ?>
    <?php $integer = intval($row['DATEDIFF(FechaAdmin, FechaRegistro)']);

       // echo $integer;

        if($integer <= 1)
        {
            $tiempoad++;
         //   echo ' A tiempo'.'<br>';
            
        }else
        {
            $no_tiempoad++;
          // echo ' Destiempo'.'<br>';
            
        }


    ?>   
    <?php     
}

$RAF=  ($tiempoad*20)/$cuentafila;
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
  ?>
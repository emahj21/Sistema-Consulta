<?php

include ('../conexion.php');


$query = "SELECT OCDefDev, OCDefAcep FROM uordencompra
WHERE FechaVoBo BETWEEN '2021-12-01' AND '2021-12-15' ";

$resultado = $conexion->query($query);
$defectos = 0;
$buenos;

while($row = $resultado->fetch_assoc())
{
  if($row['OCDefDev']!=0 || $row['OCDefAcep']!=0)
  {
    $defectos++;
  }
}

echo 'Total Defectos '.$defectos;


?>
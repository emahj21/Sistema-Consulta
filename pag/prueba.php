<?php

include("../conexion.php");

$query = "SELECT FechaRegistro FROM upedido";
$resultado = $conexion->query($query);

while($row=$resultado->fetch_assoc())
{
    $int = intval($row['FechaRegistro']);
    
}

echo $int;

?>
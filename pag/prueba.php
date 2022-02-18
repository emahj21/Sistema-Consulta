<?php

include("../conexion.php");

$query = "SELECT FechaRegistro FROM upedido";
$resultado = $conexion->query($query);

while($row=$resultado->fetch_assoc())
{
    $int = intval($row['FechaRegistro']);
    
}

echo $int;


//----------Funcion para consulta de Reclamos----------
function reclamos($f1,$f2,$area){
    //conexion
    $db = mysqli_connect('localhost', 'root', '', 'unibrandprod');
    //Consultas Reclamo
    //$queryReclamo = "SELECT reclamacion,FechaRegistro, dayofweek(FechaRegistro)  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2' AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6);";
    //$queryReclamo = "SELECT reclamacion,FechaRegistro, dayofweek(FechaRegistro)  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2' AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6,7);";
    $queryReclamo = "SELECT reclamacion,FechaRegistro  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2';";
    $queryPuntosReclamo = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId='$area' AND configuracionindindicadores.IndId=4;";
    $resultado = $db->query($queryReclamo);
    $resultado2 = $db->query($queryPuntosReclamo);
    
    $totalR = 0;
    //Recorrido de consultas
    while ($row2 = $resultado2->fetch_assoc()) {
        $puntosR = intval($row2['PesoPuntos']);
    }

    while ($row = $resultado->fetch_assoc()) {

        if ($row['reclamacion'] != 0) {
            $totalR++;
        }
    }
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
    echo $totalR."<br>";
}

?>
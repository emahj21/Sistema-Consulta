<?php



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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Tabla</title>
</head>

<body>
    <!-- <table border="1">
        <?php
        $db = mysqli_connect('localhost', 'root', '', 'unibrandprod');
        /*$query="SELECT * FROM usuario";
            $consulta=mysqli_query($db,$query);
            
        while($row = mysqli_fetch_array($consulta)){ ?>
            <!--$tabla_usuario[$i]['id']=$row['idusuario'];-->
            <tr>    
                <td><?php echo $row['idusuario']?></td>
                <td><?php echo $row['usernombre']?></td>
                <td><?php echo $row['usertipo']?></td>
                <td><?php echo $row['userini']?></td>
                <td><?php echo $row['usercontra']?></td>
                <td><?php echo $row['correoelectronico']?></td>
            </tr>
        <?php }  */ ?>    
    </table> -->

    <?php
    $f1='2021-07-06';
    $f2='2021-09-20';
    $area=1;
    reclamos($f1,$f2,$area);
    $area=2;
    reclamos($f1,$f2,$area);
    $area=4;
    reclamos($f1,$f2,$area);
    $area=5;
    reclamos($f1,$f2,$area);
    $area=6;
    reclamos($f1,$f2,$area);
    $area=7;
    reclamos($f1,$f2,$area);
    $area=8;
    reclamos($f1,$f2,$area);
    $area=11;
    reclamos($f1,$f2,$area);

    ?>
</body>

</html>
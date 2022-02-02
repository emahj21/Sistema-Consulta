<?php
    $conexion = new mysqli("localhost", "root", "", "bd_uni");

    if($conexion)
    {
        //echo 'Hola prros xD';

    }else{
        echo 'Falló la conexión';
    }
?>
<?php require "prueba_consulta.php";
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
    <table border="1">
        <?php 
            $db=mysqli_connect('localhost','root','','bd_uni');
            $query="SELECT * FROM usuario";
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
        <?php } ?>    
    </table>
</body>
</html>
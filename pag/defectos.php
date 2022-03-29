<?php 

include("../conexion.php");
include("consulta_gral.php");


$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];
$ind= '8';
$ind2= '3';
$cadena=[];
$j=0;
//---------- Consultas ----------

$query = "SELECT OCDefDev, OCDefAcep FROM uordencompra WHERE FechaVoBo BETWEEN '$f1' AND '$f2' ";
  
$peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 
//---------- Variables ----------
$resultadoPeso = $conexion->query($peso);

$resultado = $conexion->query($query);
$defectos = 0;
$totalPedidos = 0;
$valTotal = 0;

while($row3 = $resultadoPeso->fetch_assoc()){
  $peso = intval($row3['PesoPuntos']);
}
if($resultado){
  $totalPedidos=mysqli_num_rows($resultado);  
}

while($row = $resultado->fetch_assoc()){
  if($row['OCDefDev']!=0 || $row['OCDefAcep']!=0)
  {
    $cadena[$j] = '<h5>&#10060;</h5>';
    $j++;
  }
  else
  {
    $cadena[$j] = '<h5>&#x2714;</h5>';
    $j++;
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="../images/ico.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

    <title>Administración</title>
  </head>
  <body class="m-0 ">
   <!--  <h1 class="text-center mt-5">Área de Administración</h1> -->
    <div class="container" id="tabla">
        <div class="row" id="tablaDefectos">
          
            <table  class="table">
                
                    <thead  class="thead-dark">
                    <tr>
                        <td align="center" width="150">ID Orden de Compra</td>
                        <td align="center">Tipo OC</td>
                        <td align="center">Proveedor</td>
                        <td align="center">Defectos Devueltos</td>
                        <td align="center" width="150">Defectos Aceptados</td>
                        <td align="center" width="150">Estatus</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        include("../conexion.php");
                        

                        /* $query= "SELECT FechaRegistro, FechaAdmin, Idpedido, PeFeReqCli, FechaLiberacion, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)"; */
                            $query = "SELECT oc.OCDefDev, oc.OCDefAcep, oc.IDOC, oc.ProvId, Proveedor, DescripcionOC, oc.FechaVoBo FROM uordencompra oc
                            INNER JOIN proveedores ON  oc.ProvId = proveedores.ProvId
                            INNER JOIN utipooc ON oc.IdTipoOC = utipooc.IdTipoOC
                            WHERE FechaVoBo BETWEEN '$f1' AND' $f2'";


                        $resultado= $conexion->query($query);
                        $i=0;
                        while($row=$resultado->fetch_assoc()){
                    ?>

                    <tr>
                        <td align="center"><?php echo $row['IDOC'] ?></td>
                        <td align="center"><?php echo $row['DescripcionOC']?></td>
                        <td align="center"><?php echo $row['Proveedor'] ?></td> 
                        <td align="center"><?php echo $row['OCDefDev'] ?></td>   
                        <td align="center"><?php echo $row['OCDefAcep'] ?></td> 
                        <td align="center"><?php echo $cadena[$i];$i++?></td> 
                      
                    </tr>

                    <?php
                        }
                        ?>
                </tbody>
            </table>
            <button class="btn " style="border-color: #000; " onclick="ocultar();">Ocultar</button>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function ocultar()
        {
            document.getElementById('tablaDefectos').style.display = 'none';
        }
    </script>

    <!-- Gráfica -->

  </body>
</html>
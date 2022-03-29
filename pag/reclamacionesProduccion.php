<?php 

include("../conexion.php");
include("consulta_gral.php");


$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];

$totalR = 0;
  $puntosR = 0;
  $reclamos = 0;
  $j=0;
  $cadena = [];
  $cadena2 = [];
  //Consultas Reclamo
  $queryReclamo = "SELECT reclamacion,FechaRegistro  FROM upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'";

  $resultado = $conexion->query($queryReclamo);
  while ($row = $resultado->fetch_assoc()) {

    if ($row['reclamacion'] != 0) {
      $reclamos ++;
      $totalR++;
      $cadena[$j] = 1;
      $cadena2[$j] = '<h5>&#10060;</h5>' ;
      $j++;
    }else
    {
        $cadena[$j] = 0;
        $cadena2[$j] = '<h5>&#x2714;</h5>';
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
    <script src="js/filtro.js"></script>

    <title>Administración</title>
  </head>
  <body class="m-0 ">
      <div class="container" id="tablas">
        <div class="row" id="reclamacionesProduccion">
          <div style="text-align: center;">
              <select id="selectCategory" align="center">
                <option value="">Selecciona Filtro</option>
                <option value="">Todos</option>
                <option value="&#x2714">&#x2714;</option>
                <option value="&#10060">&#10060;</option>
              </select>
            </div>

            <h3>Reclamaciones</h3>
            <table  class="table">
                
                    <thead  class="thead-dark">
                    <tr>
                        <td>Nombre del Cliente</td>
                        <td>Número de Pedido</td>
                        <td>Fecha de Inicio</td>
                        <td>Reclamos</td>
                        <td>Estatus</td>
                    </tr>
                    </thead>
                    <tbody id="tabla">
                    <?php
                        include("../conexion.php");
                        

                        /* $query= "SELECT FechaRegistro, FechaAdmin, Idpedido, PeFeReqCli, FechaLiberacion, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)"; */
                        $query = "SELECT upedido.Idpedido, upedido.reclamacion, upedido.FechaRegistro, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                        INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                        INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                        WHERE FechaRegistro BETWEEN '$f1' AND '$f2';";


                        $resultado= $conexion->query($query);
                        $i=0;
                        $k=0;
                        while($row=$resultado->fetch_assoc()){
                    ?>

                    <tr>
                        <td align="center"><?php echo $row['CRazonSocial'] ?></td>
                        <td align="center"><?php echo $row['Idpedido'] ?></td> 
                        <td align="center"><?php echo $row['FechaRegistro'] ?></td> 
                        <td align="center"><?php echo $cadena[$i]; $i++;?></td>
                        <td align="center"><?php echo $cadena2[$k]; $k++;?></td>
                      
                    </tr>

                    <?php
                        }
                        ?>
                </tbody>
            </table>
            <button class="btn" style="border-color: #000; " onclick="ocultar();">Ocultar</button>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function ocultar()
        {
          {
          var x = document.getElementById("reclamacionesProduccion");
          if (x.style.display === "none") {
              x.style.display = "block";
          } else {
              x.style.display = "none";
          }
        }
        }
    </script>

    <!-- Gráfica -->

  </body>
</html>
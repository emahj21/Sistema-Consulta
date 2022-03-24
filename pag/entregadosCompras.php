<?php

include("../conexion.php");
include("consulta_gral.php");

$totalPedidos = 0;
$pedidosBuenos = 0;
$pedidosEntregados = 0;
$puntosP = 0;
$mensaje = [];
$i = 0;
$query = "SELECT FechaEmp,PeFeReqCli FROM upedido WHERE FechaEmp BETWEEN '$f1' AND '$f2' ";
$queryPuntosPedidos = "SELECT PesoPuntos FROM configuracionindindicadores WHERE configuracionindindicadores.ConId=1 AND configuracionindindicadores.Indicador='Pedidos entregados';";

$resultado = $conexion->query($query);
$resultado2 = $conexion->query($queryPuntosPedidos);

if ($resultado) {
  $totalPedidos = mysqli_num_rows($resultado);
}
while ($row2 = $resultado2->fetch_assoc()) {
  $puntosP = intval($row2['PesoPuntos']);
}

while ($row = $resultado->fetch_assoc()) {
  if ($row['FechaEmp'] <= $row['PeFeReqCli']) {
    $pedidosBuenos++;
    $mensaje[$i] = '<h5>&#x2714;</h5>';
    $i++;
  } else {
    $mensaje[$i] = '<h5> &#10060; </h5>';
    $i++;
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
  <script href="../js/filtro.js" type="text/javascript"></script>

  <title>Administración</title>
</head>

<body class="m-0 ">
  <!--  <h1 class="text-center mt-5">Área de Administración</h1> -->
  <div class="container" id="tabla">
      <div class="row" id="tablaCompras">
        <div style="text-align: center;">
            <select id="selectCategory" align="center">
                <option value="">Selecciona Filtro</option>
                <option value="">Todos</option>
                <option value="&#x2714">&#x2714;</option>
                <option value="&#10060">&#10060;</option>
            </select>
        </div>
      <h3>Pedidos Entregados</h3>
      <table class="table" >

        <thead class="thead-dark">
          <tr>
            <td>Nombre del Cliente</td>
            <td>Número de Pedido</td>
            <td>Fecha de Empaque</td>
            <td>Fecha Requerida por el Cliente</td>
            <td>Estatus</td>
          </tr>
        </thead>
        <tbody  id="tabla">
          <?php
          include("../conexion.php");


          /* $query= "SELECT FechaRegistro, FechaAdmin, Idpedido, PeFeReqCli, FechaLiberacion, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)"; */
          $query = "SELECT upedido.Idpedido, upedido.FechaEmp, upedido.PeFeReqCli, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                        INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                        INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                        WHERE FechaEmp BETWEEN '$f1' AND '$f2'";


          $resultado = $conexion->query($query);
          $i = 0;
          while ($row = $resultado->fetch_assoc()) {
          ?>

            <tr>
              <td align="center"><?php echo $row['CRazonSocial'] ?></td>
              <td align="center"><?php echo $row['Idpedido'] ?></td>
              <td align="center"><?php echo $row['FechaEmp'] ?></td>
              <td align="center"><?php echo $row['PeFeReqCli'] ?></td>
              <td align="center"><?php echo $mensaje[$i]; $i++ ?></td>
            </tr>

          <?php
          }
          ?>
        </tbody>
    </table>
    <button class="btn" style="border-color: #000; " id="switchField1" onclick="ocultar();">Ocultar</button>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

  <script>
    function ocultar() {
      document.getElementById('tablaCompras').style.display = 'none';
    }
  </script>


    <script type="text/javascript">
        function ocultar1()
        {
          $('#tabla').hide();                   
        };
    </script>

    <script>
      $("#selectCategory").change(function () {
        if(this.value != "Todos")
          {
        //split the current value of searchInput
        var data = this.value.split(" ");
        //create a jquery object of the rows
        var jo = $("#tabla").find("tr");
        if (this.value == "") {
            jo.show();
            return;
        }
        //hide all the rows
        jo.hide();
        
        //Recusively filter the jquery object to get results.
        jo.filter(function (i, v) {
            var $t = $(this);
            for (var d = 0; d < data.length; ++d) {
                if ($t.is(":contains('" + data[d] + "')")) {
                    return true;
                }
            }
            return false;
        })
        //show the rows that match.
        .show();
          }
        }).focus(function () {
        this.value = "";
        $(this).css({
            "color": "black"
        });
        $(this).unbind('focus');
        }).css({
        "color": "#C0C0C0"
        });

    
    </script>


      <script>
        $(document).ready(function(){
        $("#switchField1").click(function() {
            $("#tabla").toggle(500);// Mostrar y ocultar el tiempo de cambio de acción es de 500 ms
        });
        });
    </script>
  

</body>

</html>
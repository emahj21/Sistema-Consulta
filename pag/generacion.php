

<?php 

include("../conexion.php");


$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];
$FechaI = 'SDeFeSol';
$FechaF = 'SDeFeEnvio';
$tabla = 'solicituddetalle';
$proc = 'IC';
//---------- Variables ----------
$query = "SELECT " . $FechaI . ", " . $FechaF . ", DATEDIFF(" . $FechaF . ", " . $FechaI . ") from " . $tabla . " WHERE " . $FechaI . " BETWEEN '$f1' AND '$f2'";
$dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
$festivo = "SELECT DFFecha from diasfest";
$resultado = $conexion->query($query);
$resultado2 = $conexion->query($dia);
$j = 0;
$a_tiempo = 0;
$contador_dias = 0;
$cadena = [];

$resultado1 = $conexion->query($festivo);
if ($resultado) {
  $totalPedidos = mysqli_num_rows($resultado);
}
while ($row2 = $resultado2->fetch_assoc()) {
  $val = intval($row2['Diastotal']);
}

while ($row1 = $resultado1->fetch_assoc()) {
  while ($row = $resultado->fetch_assoc()) {

    $integer2 = intval($row['DATEDIFF(' . $FechaF . ', ' . $FechaI . ')']);

    for ($i = 0; $i < $integer2; $i++) {
      if (($row[$FechaI] != $row1['DFFecha'])) {
        $aux = date("d-m-Y", strtotime($row[$FechaI] . "+ 1 days"));
        $row[$FechaI] = $aux;

        if (date("w", strtotime($row[$FechaI])) != 0) {
          $contador_dias++;
        }
      } else {
        $aux = date("d-m-Y", strtotime($row[$FechaI] . "+ 1 days"));
        $row[$FechaI] = $aux;
      }
    }
    if ($contador_dias <= $val) {
      $cadena[$j] = '<h5>&#x2714;</h5>';
      $j++;
    } else {
      $cadena[$j] = '<h5>&#10060;</h5>';
      $j++;
    }
    $contador_dias = 0;
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
  
    
    <div class="container" id="tablas">
      <div style="text-align: center;">
        <select id="selectCategory" align="center">
          <option value="">Selecciona Filtro</option>
          <option value="">Todos</option>
          <option value="&#x2714">&#x2714;</option>
          <option value="&#10060">&#10060;</option>
        </select>
      </div>
        <div class="row">
   <table  class="table" width="" >
                
                    <thead  class="thead-dark">
                    <tr>
                        <td>Cotización</td>
                        <td>Id Solicitud</td>
                        <td>Tipo</td>
                        <td>Fecha de Inicio</td>
                        <td>Fecha de Término</td>
                        <td>Estatus</td>
                    </tr>
                    </thead>
                    <tbody  id="tabla">
                    <?php
                        include("../conexion.php");
                        

                        /* $query= "SELECT FechaRegistro, FechaAdmin, Idpedido, PeFeReqCli, FechaLiberacion, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)"; */
                        $query = "SELECT SolCotizacion, SDeId, SDeTipo, SDeFeSol, SDeFeEnvio from solicituddetalle
                        WHERE SDeFeSol BETWEEN '$f1' AND '$f2'";


                        $resultado= $conexion->query($query);
                        $i=0;
                        while($row=$resultado->fetch_assoc()){
                    ?>

                    <tr>
                        <td><?php echo $row['SolCotizacion'] ?></td>
                        <td><?php echo $row['SDeId'] ?></td> 
                        <td><?php echo $row['SDeTipo']?></td>
                        <td><?php echo $row['SDeFeSol'] ?></td> 
                        <td><?php echo $row['SDeFeEnvio'] ?></td>
                        <td><?php echo $cadena[$i];$i++ ?></td>
                      
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
          var x = document.getElementById("tablas");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
        }
        }
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
  </body>
</html>
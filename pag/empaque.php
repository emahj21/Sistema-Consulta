<?php

include("../conexion.php");


$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];
$FechaI = 'FechaEmpR';
$FechaF = 'FechaProcesos';
$tabla = 'uempaque';
$tabla2 = 'upedido';
$proc = 'Emp';
$j = 0;
//---------- Variables ----------
$query = "SELECT " . $tabla . "." . $FechaI . ", " . $tabla2 . "." . $FechaF . ", DATEDIFF(" . $tabla2 . "." . $FechaF . ", " . $tabla . "." . $FechaI . ")FROM " . $tabla . " INNER JOIN " . $tabla2 . " ON " . $tabla . ".Idpedido = " . $tabla2 . ".Idpedido WHERE " . $tabla . "." . $FechaI . " BETWEEN '$f1' AND '$f2';";

$festivo = "SELECT DFFecha from diasfest";
$dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
//$peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 

$resultado = $conexion->query($query);
$resultado1 = $conexion->query($festivo);
$resultado2 = $conexion->query($dia);
//$resultadoPeso = $conexion->query($peso);

//---------- Variables ----------
$contador_dias = 0;
$a_tiempo = 0;
$integer2 = 0;
$diaFestivo = [];
if ($resultado) {
    $totalPedidos = mysqli_num_rows($resultado);
}
//Recorrido total días
while ($row2 = $resultado2->fetch_assoc()) {
    $val = intval($row2['Diastotal']);
}


//Recorrido Puntos
/* while($row3 = $resultadoPeso->fetch_assoc()){
    $peso = intval($row3['PesoPuntos']);
} */
//Recorrido Fechas
while ($row1 = $resultado1->fetch_assoc()) {

    array_push($diaFestivo, $row1['DFFecha']);
}

while ($row = $resultado->fetch_assoc()) {
    if ($tabla2 == null) {
        if ($row[$FechaF] == '1000-01-01 00:00:00' || $row[$FechaF] == '1000-01-01') {
            $aux = date('d-m-Y');
            $row[$FechaF] = $aux;

            $date1 = new DateTime($row[$FechaI]);
            $date2 = new DateTime($row[$FechaF]);
            $diff = $date1->diff($date2);

            $integer2 = intval($diff->days);
        } else {

            $integer2 = intval($row['DATEDIFF(' . $FechaF . ', ' . $FechaI . ')']);
        }
    } else {
        $integer2 = intval($row['DATEDIFF(' . $tabla2 . '.' . $FechaF . ', ' . $tabla . '.' . $FechaI . ')']);
    }
    for ($i = 0; $i < $integer2; $i++) {
        //if( ($row[$FechaI] != $row1['DFFecha'])){   
        if (($row[$FechaI] != $diaFestivo[$i])) {
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
        $a_tiempo++;
        $cadena[$j] = '<h5>&#x2714;</h5>';
        $j++;
    } else {
        $cadena[$j] = '<h5>&#10060;</h5>';
        $j++;
    }
    $contador_dias = 0;
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
        <div class="row" id="tablaEmpaque">
            <div style="text-align: center;">
                <select id="selectCategory" align="center">
                    <option value="">Selecciona Filtro</option>
                    <option value="">Todos</option>
                    <option value="&#x2714">&#x2714;</option>
                    <option value="&#10060">&#10060;</option>
                </select>
            </div>
            <h3>Empaque</h3>
            <table class="table" width="">

                <thead class="thead-dark">
                    <tr>
                        <td>Id Empaque</td>
                        <td>Id Pedido</td>
                        <td>Fecha de Inicio</td>
                        <td>Fecha de Término</td>
                        <td>Estatus</td>
                    </tr>
                </thead>
                <tbody id="tabla">
                    <?php
                    include("../conexion.php");


                    /* $query= "SELECT FechaRegistro, FechaAdmin, Idpedido, PeFeReqCli, FechaLiberacion, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)"; */
                    $query = "SELECT ue.IdEmp, ue.Idpedido, ue.FechaEmpR, FechaProcesos FROM uempaque ue
                        INNER JOIN upedido ON ue.Idpedido = upedido.Idpedido
                        WHERE FechaEmpR BETWEEN '$f1' AND '$f2'";


                    $resultado = $conexion->query($query);
                    $i = 0;
                    while ($row = $resultado->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $row['IdEmp'] ?></td>
                            <td><?php echo $row['Idpedido'] ?></td>
                            <td><?php echo $row['FechaEmpR'] ?></td>
                            <td><?php echo $row['FechaProcesos'] ?></td>
                            <td><?php echo $cadena[$i];
                                $i++ ?></td>

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
        function ocultar() {
            {
                document.getElementById("tablaEmpaque").style.display = "none";
            }
        }
    </script>

    <script>
        $("#selectCategory").change(function() {
            if (this.value != "Todos") {
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
                jo.filter(function(i, v) {
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
        }).focus(function() {
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
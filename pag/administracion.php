<?php 

include("../conexion.php");
include("../consulta.php")
$f1 = $_GET['Fein'];
$f2 = $_GET['Fefin'];

$query = "SELECT FechaAdmin, FechaComp, DATEDIFF (FechaComp, FechaAdmin) from upedido WHERE FechaAdmin BETWEEN '$f1' AND '$f2'";  
$resultado = $conexion->query($query);


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
    <h1 class="text-center mt-5">Área de Administración</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <canvas id="MiGrafica" class="justify-content-center"></canvas>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Gráfica -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Entregados a tiempo", "No Entregados a tiempo"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [2, 6]
                }
            ]
        }
     
        //ctx.update();
        //ctx.destroy();
    }); 
</script>
  </body>
</html>
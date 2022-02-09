<?php 
echo '<h1 align="center"> Indicadores </h1>';
  include("conexion.php");

  $f1 = $_POST['f1'];
  $f2 = $_POST['f2'];

  $query = "SELECT fechain, fechafin, DATEDIFF (fechafin, fechain) from fechas WHERE fechain BETWEEN '$f1' AND '$f2'";

  $resultado = $conexion->query($query);
  $tiempo = 0;
  $no_tiempo = 0;
  while($row=$resultado->fetch_assoc()){
      ?>
    <?php $integer = intval($row['DATEDIFF (fechafin, fechain)']);

        echo $integer;

        if($integer <= 7)
        {
            $tiempo++;
            echo ' A tiempo'.'<br>';
            
        }else
        {
            $no_tiempo++;
            echo ' Destiempo'.'<br>';
            
        }


    ?>
        
    <?php
       
}

echo 'Entregados a tiempo: '.$tiempo.'<br>';
echo 'No entregados a tiempo: '.$no_tiempo;



  /* $query= "SELECT * FROM fechas WHERE fechain ";
  $resultado= $conexion->query($query);

  $query2= "SELECT * FROM fechas WHERE fechain BETWEEN '$f1' AND '$f2'  AND ent_tiempo='no'";

    $resultado2= $conexion->query($query2);
    $cuentafila2 = mysqli_num_rows($resultado2);

    $query3= "SELECT * FROM fechas WHERE fechain BETWEEN '$f1' AND '$f2'  AND ent_tiempo='si'";

    $resultado3= $conexion->query($query3);
    $cuentafila3 = mysqli_num_rows($resultado3);




$integer = intval($cuentafila2);
$integer2 = intval($cuentafila3);
 */
//echo $integer;

  ?>




<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="icon" href="images/ico.ico">
  

<title>Inidicadores</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <canvas id="MiGrafica" width="500" height="300"></canvas>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<script>

    let miCanvas=document.getElementById("MiGrafica").getContext("2d");

    var chart = new Chart(miCanvas,{
        type: "bar",
        data:{
            labels:["Entregados a tiempo", "No Entregados a tiempo"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor: "#EF172F",
                data: [<?php echo $tiempo?>, <?php echo $no_tiempo?>]
                }
            ]
        }
    })
</script>
</html>
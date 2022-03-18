<?php require("pag/prueba.php");
echo '<h1 align="center"> Indicadores </h1>';
  include("conexion.php");

  $f1 = $_POST['Fein'];
  $f2 = $_POST['Fefin'];
  
  $queryAreas="SELECT Area FROM configuracionind";
  $consultaAreas=mysqli_query($conexion,$queryAreas);
  $tabla_areas=[];
  $i=0;  
  while($row = mysqli_fetch_array($consultaAreas)){
        $tabla_areas[$i]['nombre']=$row['Area'];
        $i++;
  }
  

<<<<<<< Updated upstream
  $query = "SELECT FechaAdmin, FechaComp, DATEDIFF (FechaComp, FechaAdmin) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'";
    
=======
  $query = "SELECT FechaAdmin, FechaComp, DATEDIFF (FechaComp, FechaAdmin) from upedido WHERE FechaAdmin BETWEEN '$f1' AND '$f2'";

  $query2 = "SELECT FechaComp, FechaLog, DATEDIFF (FechaLog, FechaComp) from upedido WHERE FechaComp BETWEEN '$f1' AND '$f2'";

  $query3 = "";

 /*  $ind = "SELECT AREA FROM configuracionind WHERE AREA = 'Administracion'";
  $resul = $conexion->query($ind);
  echo $resul; */

>>>>>>> Stashed changes
  $resultado = $conexion->query($query);
  $resultado1 = $conexion->query($query2);
  $tiempoad = 0;
  $no_tiempoad = 0;

  $tiempocom = 0;
  $no_tiempocom = 0;

  while($row1=$resultado1->fetch_assoc()){
      ?>
      <?php $integer2 = intval($row1['DATEDIFF (FechaLog, FechaComp)']);

      if($integer2 <=15)
      {
          $tiempocom++;
      }else
      {
          $no_tiempocom++;
      }
      ?>
      <?php
  }
  ?>
<?php   

  while($row=$resultado->fetch_assoc()){
      ?>
    <?php $integer = intval($row['DATEDIFF (FechaComp, FechaAdmin)']);

       // echo $integer;

        if($integer <= 7)
        {
            $tiempoad++;
         //   echo ' A tiempo'.'<br>';
            
        }else
        {
            $no_tiempoad++;
          // echo ' Destiempo'.'<br>';
            
        }
    ?>   
    <?php     
}

/* echo 'Entregados a tiempo: '.$tiempo.'<br>';
echo 'No entregados a tiempo: '.$no_tiempo;
 */


  ?>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="icon" href="images/ico.ico">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="sweetalert2.min.css">
  

<title>Inidicadores</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
<<<<<<< Updated upstream
        <div class="col-sm-6">
            <h3 class="text-center"><?php echo implode("",$tabla_areas[0]);?></h3>
=======
        <div class="col-sm-6" >
            <h3>Administración</h3>
>>>>>>> Stashed changes
            <canvas id="MiGrafica" width="500" height="300"></canvas>
            <button class="btn" onClick="mensaje();">Ver más</button>
        </div>
<<<<<<< Updated upstream
        <div class="col-sm-6">            
            <h3 class="text-center"><?php echo implode("",$tabla_areas[1]);?></h3>
=======
        <div class="col-sm-6"> 
            <h3>Compras</h3>           
>>>>>>> Stashed changes
            <canvas id="MiGrafica2" width="500" height="300"></canvas>
            <button class="btn" onClick="mensaje();">Ver más</button>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Scripts -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/mensaje.js"></script>
</body>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica").getContext("2d");
    var container = document.getElementById('1');

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Entregados a tiempo", "No Entregados a tiempo"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor: "#EF172F",
                data: [<?php echo $tiempoad?>, <?php echo $no_tiempoad?>]
                },
                {
                label: "2",
                backgroundColor: "#EF102F",
                data: [<?php echo $tiempocom?>, <?php echo $no_tiempocom?>]
                }
            ]

        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica2").getContext("2d");

    var chart = new Chart(ctx,{
        type: "doughnut",
        data:{
            labels:["Entregados a tiempo", "No Entregados a tiempo"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(255, 99, 132)',
                                  'rgb(54, 162, 235)'],
                data: [<?php echo $tiempocom?>, <?php echo $no_tiempocom?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>




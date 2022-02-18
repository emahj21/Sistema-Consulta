<?php

include('consulta.php');

?>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="icon" href="images/ico.ico">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/mensaje.js"></script>
<script src="js/ajax.js"></script>


<title class="mt-5">Inidicadores</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12" >
            <h3 class="text-center"><?php echo implode("",$tabla_areas[0]);?></h3>
            <canvas id="MiGrafica" style="width: 800px; height: 400px;"></canvas>
            <a class="btn" target="_blank" id="Ver">Ver más</a>
            <div id="con"></div>

            
        </div>
        <div class="col-sm-12   "> 
            <h3 class="text-center"><?php echo implode("",$tabla_areas[1]);?></h3>         
            <canvas id="MiGrafica2" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button>
            <div id="con"></div>

            <h3 class="text-center"><?php echo implode("",$tabla_areas[2]);?></h3>
            <canvas id="MiGrafica3" width="500" height="300"></canvas>
            <a class="btn"  href="pag/administracion.php" target="_blank">Ver más</a>

            <h3 class="text-center">Imagen</h3>
            <canvas id="MiGrafica4" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button>

            <h3 class="text-center"><?php echo implode("",$tabla_areas[4]);?></h3>
            <canvas id="MiGrafica5" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button>

            <h3 class="text-center"><?php echo implode("",$tabla_areas[5]);?></h3>
            <canvas id="MiGrafica6" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button>

            <h3 class="text-center"><?php echo implode("",$tabla_areas[6]);?></h3>
            <canvas id="MiGrafica7" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button>

            
            <h3 class="text-center"><?php echo implode("",$tabla_areas[7]);?></h3>
            <canvas id="MiGrafica8" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button>

<!--             <h3 class="text-center"><?php echo implode("",$tabla_areas[8]);?></h3>
            <canvas id="MiGrafica9" width="500" height="300"></canvas>
            <button class="btn" onclick="mensaje();">Ver más</button> -->
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica").getContext("2d");
    var container = document.getElementById('1');

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Revisión de Anticipos y Facturas", "Liberación", "Reclamaciones", "Pedidos entregados"],
            datasets:[
                {
                labels: "Mi gráfica",
                backgroundColor: [ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                
                data: [<?php echo $RAF?>, <?php echo $LIB?>, <?php echo reclamos($f1,$f2,$conexion,$area=1)?>,<?php echo $PEA?>]
                },
 /*                {
                label: "2",
                backgroundColor: "#EF102F",
                data: [<?php echo $tiempocom?>, <?php echo $no_tiempocom?>]
                } */
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
        type: "bar",
        data:{
            labels:["Generación de OC's", "Recepción de OC's", "Reclamaciones" , "Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [<?php echo $tiempocom?>, <?php echo $no_tiempocom?>,<?php echo reclamos($f1,$f2,$conexion,$area=2)?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica3").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
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
    var ctx = document.getElementById("MiGrafica4").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Generación de Fichas", "Autorización de Fichas", "Personalización", "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [<?php echo $tiempocom?>,<?php echo $no_tiempocom?>,<?php echo $no_tiempocom?>,<?php echo reclamos($f1,$f2,$conexion,$area=4)?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica5").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Empaque" , "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [<?php echo $tiempocom?>,<?php echo reclamos($f1,$f2,$conexion,$area=5)?>, <?php echo $no_tiempocom?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica6").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Pedidos Registrados", "Pedidos a Asesores" , "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [<?php echo $tiempocom?>, <?php echo $no_tiempocom?>,<?php echo reclamos($f1,$f2,$conexion,$area=6)?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica7").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Revisiones", "Recepción OC's", "Recolección" , "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [<?php echo $tiempocom?>,<?php echo $no_tiempocom?>,<?php echo $no_tiempocom?>,<?php echo reclamos($f1,$f2,$conexion,$area=7)?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica8").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Revision Maquilas #1" , "Revisión Maquilas #2", "Defectos de calidad","Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Mi gráfica",
                backgroundColor:[ 'rgb(17, 169, 7)',
                                  'rgb(195, 3, 3)'],
                data: [<?php echo $tiempocom?>,<?php echo $no_tiempocom?>,<?php echo $no_tiempocom?>,<?php echo reclamos($f1,$f2,$conexion,$area=8)?>]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>








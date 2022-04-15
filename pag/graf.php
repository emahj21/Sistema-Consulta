<?php



include("../conexion.php");
include('consulta.php');
//include('prueba.php');
$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];


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
<script src="js/filtro.js"></script>


<title class="mt-5">Inidicadores</title>
</head>
<body>

<div class=" mt-5">
    <div class="row">
        <div class="col-sm-12" >
            <h3 class="text-center">Calificaciones Generales</h3>
            <canvas id="Global" width="500" height="300"></canvas>
        </div><!-- Gráfica General -->

        <div class="col-sm-12"> 
            <h3 class="text-center"><?php echo implode("",$tabla_areas[0]);?></h3>
            <h5 align="center">Calificación 
                <?php $calificacion = (dias($conexion,'FechaRegistro', 'FechaAdmin',$f1,$f2,'upedido',null,'Admin' ,'1', '1')+
                dias($conexion,'FechaEmp', 'FechaLiberacion',$f1,$f2,'upedido',null,'Admin' , '1', '1')+
                reclamos($f1,$f2,$conexion,$area=1)+
                pedidosEntregado($f1,$f2,$conexion,$area=1))/10; 
                echo round($calificacion,2);?>
            </h5>
            <canvas id="MiGrafica" style="width: 800px; height: 400px;"></canvas>
            <a class="btn" target="_blank" id="adm1">Revisión Anticipos y Fac.</a>
            <a class="btn" target="_blank" id="adm2">Liberación</a>
            <a class="btn" target="_blank" id="adm3">Reclamaciones</a>
            <a class="btn" target="_blank" id="adm4">Pedidos Entregados</a>
            <div id="con"></div>
        </div><!-- Gráfica Administración -->


    </div>
</div>

        <div class="col-sm-12">
            <h3 class="text-center"><?php echo implode("",$tabla_areas[1]);?></h3>  
            <h5 align="center">Calificación 
                <?php $calificacion2 = (dias($conexion,'FechaAdmin', 'FechaRegOC', $f1, $f2, 'upedido', 'uordencompra', 'Comp', '2', '1')+
                oc($conexion, $f1, $f2,'2','2')+
                reclamos($f1,$f2,$conexion,$area=2)+
                pedidosEntregado($f1,$f2,$conexion,$area=2))/10; 
                echo round($calificacion2,2);?>
            </h5>      
            <canvas id="MiGrafica2" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="comp1">Generación de OC's</a>
            <a class="btn" target="_blank" id="comp2">Recepción de OC's</a>
            <a class="btn" target="_blank" id="comp3">Reclamaciones</a>
            <a class="btn" target="_blank" id="comp4">Pedidos Entregados</a>
            <div id="con2"></div>
        </div><!-- Gráfica Compras -->


            <h3 class="text-center"><?php echo implode("",$tabla_areas[2]);?></h3>
            <h5 align="center"> Calificación
                <?php $logistica =  pedidosEntregado($f1,$f2,$conexion,$area=3);
                echo round($logistica,2)?>
            </h5> 
            <canvas id="MiGrafica3" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="log1">Pedidos Entregados</a>
            <div id="logis"></div>
            <!-- Gráfica Logística -->

            <h3 class="text-center">Imagen</h3>

            <canvas id="MiGrafica4" width="500" height="300"></canvas>
            <a class="btn" id="img1">Gen. de Fichas</a>
            <a class="btn" id="img2">Aut. de Fichas</a>
            <a class="btn" id="img3">Personalización</a>
            <a class="btn" id="img4">Reclamaciones</a>
            <a class="btn" id="img5">Pedidos Entregados</a>
            <div id="con4"></div>
            <!-- Gráfica Imagen -->
            

            <h3 class="text-center"><?php echo implode("",$tabla_areas[4]);?></h3>
            <h5 align="center"> Calificación
                <?php $calificacion3 = (dias($conexion,'FechaEmpR', 'FechaProcesos', $f1, $f2, 'uempaque', 'upedido', 'Emp', '5', '1')+
                reclamos($f1,$f2,$conexion,$area=5) + pedidosEntregado($f1,$f2,$conexion,$area=5))/10;
                echo round($calificacion3,2)?>
            </h5>
            <canvas id="MiGrafica5" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="emp1">Empaque</a>
            <a class="btn" target="_blank" id="emp2">Reclamaciones</a>
            <a class="btn" target="_blank" id="emp3">Pedidos Entregados</a>
            <div id="con5"></div>
            <!-- Gráfica Empaque -->


            <h3 class="text-center">Backoffice</h3>
            <h5 align="center"> Calificación
                <?php $calificacion5 = (dias($conexion,'FechaEnvioBCK', 'FechaRegistro', $f1, $f2, 'upedido', null, 'Registro-Backoffice', '6', '1')+
                rechazos($conexion, $f1, $f2)+ reclamos($f1,$f2,$conexion,$area=6)+ pedidosEntregado($f1,$f2,$conexion,$area=6))/10;
                echo round($calificacion5,2)?>
            </h5>
            <canvas id="MiGrafica6" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="bck1">Pedidos Registrados</a>
            <a class="btn" target="_blank" id="bck2">Regresos a Asesores</a>
            <a class="btn" target="_blank" id="bck3">Reclamaciones</a>
            <a class="btn" target="_blank" id="bck4">Pedidos Entregados</a>
            <div id="con6"></div>
            <!-- Gráfica Backoffice -->


            <h3 class="text-center"><?php echo implode("",$tabla_areas[6]);?></h3>
            <h5 align="center">Calificación
                <?php $calificacion6 = ( dias($conexion,'FechaOCReal', 'OC1aRevFe', $f1, $f2, 'uordencompra', null, 'Rev1', '8', '1')+ dias($conexion,'FechaOCReal', 'OC2aRevFe', $f1, $f2, 'uordencompra', null, 'Rev2', '8', '2')+
                oc($conexion, $f1, $f2,'2','2')+
                recoleccion($conexion,$f1,$f2)+
                reclamos($f1,$f2,$conexion,$area=7)+
                pedidosEntregado($f1,$f2,$conexion,$area=7))/10;
                echo round($calificacion6,2)?>
            </h5>
            <canvas id="MiGrafica7" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="alm1">Revisiones</a>
            <a class="btn" target="_blank" id="alm2">Recepción OC's</a>
            <a class="btn" target="_blank" id="alm3">Recolección</a>
            <a class="btn" target="_blank" id="alm4">Reclamaciones</a>
            <a class="btn" target="_blank" id="alm5">Pedidos Entregados</a>
            <div id="con7"></div>
            <!-- Gráfica Almacen -->


            

            <h3 class="text-center"><?php echo implode("",$tabla_areas[7]);?></h3>
            <h5 align="center"> Calificación
                <?php $calificacion4 = (dias($conexion,'FechaOCReal', 'OC1aRevFe', $f1, $f2, 'uordencompra', null, 'Rev1', '8', '1')+
                dias($conexion,'FechaOCReal', 'OC2aRevFe', $f1, $f2, 'uordencompra', null, 'Rev2', '8', '2')+defectos($conexion, $f1, $f2, '8', '3')+reclamos($f1,$f2,$conexion,$area=8)+pedidosEntregado($f1,$f2,$conexion,$area=8))/10;
                echo round($calificacion4,2)?>
            </h5>
            <canvas id="MiGrafica8" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="cal1">Maquilas #1</a>
            <a class="btn" target="_blank" id="cal2">Maquilas #2</a>
            <a class="btn" target="_blank" id="cal3">Defectos</a>
            <a class="btn" target="_blank" id="cal4">Reclamaciones</a>
            <a class="btn" target="_blank" id="cal5">Pedidos Entregados</a>
            <div id="con8"></div>
            <!-- Gráfica Calidad -->

            <h3 class="text-center"><?php echo implode("",$tabla_areas[10]);?></h3>  
            <h5 align="center">Calificación 
                <?php $calificacion2 = (dias($conexion,'FechaAdmin', 'FechaRegOC', $f1, $f2, 'upedido', 'uordencompra', 'Comp', '2', '1')+
                oc($conexion, $f1, $f2,'2','2')+
                reclamos($f1,$f2,$conexion,$area=2)+
                pedidosEntregado($f1,$f2,$conexion,$area=2))/10; 
                echo round($calificacion2,2);?>
            </h5>      
            <canvas id="MiGrafica9" width="500" height="300"></canvas>
            <a class="btn" target="_blank" id="prod1">Generación de OC's</a>
            <a class="btn" target="_blank" id="prod2">Recepción de OC's</a>
            <a class="btn" target="_blank" id="prod3">Reclamaciones</a>
            <a class="btn" target="_blank" id="prod4">Pedidos Entregados</a>
            <div id="con9"></div>
            <!-- Gráfica Producción -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


<!-- Gráfica Global -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("Global").getContext("2d");
    //var container = document.getElementById('1');

    var chart = new Chart(ctx,{
        type: "bar",
        data:   {
            labels:["Administración", "Compras", "Logística ", "Imagen", "Empaque", "Backoffice", "Almacen", "Calidad", "Producción"],
            datasets:[
                {
                label: "General",
                backgroundColor: [  'rgba(188, 41, 46, 1)',
                                    'rgba(58, 56, 54, 1)',
                                    'rgba(177, 189, 191, 1)',
                                    'rgba(136, 155, 155, 1)',
                                    'rgba(71, 104, 101, 1)',
                                    'rgba(166, 65, 56, 1)',
                                    'rgba(208, 208, 208, 1)',
                                    'rgba(114, 114, 115, 1)',
                                    'rgba(177, 189, 191, 1)'
                                ],
                
                data: [
                    <?php echo $calificacion?>,
                    <?php echo $calificacion2?>,
                    <?php echo $logistica?>,
                    6,                   
                    <?php echo $calificacion3?>,
                    <?php echo $calificacion5?>,
                    <?php echo $calificacion6?>,
                    <?php echo $calificacion4?>,
                    <?php echo $calificacion2?>
                ]
                },
            ]

        }
        //ctx.update();
        //ctx.destroy();
    });

</script>

<!-- Completo -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica").getContext("2d");
   

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Revisión de Anticipos y Facturas", "Liberación", "Reclamaciones", "Pedidos entregados"],
            datasets:[
                {
                label: "Administración",
                backgroundColor: [ 'rgba(188, 41, 46, 1)'],
                
                data: [
                    <?php echo dias($conexion,'FechaRegistro', 'FechaAdmin',$f1,$f2,'upedido',null,'Admin', '1', '1')?>,
                    <?php echo dias($conexion,'FechaEmp', 'FechaLiberacion',$f1,$f2,'upedido',null,'Admin','1', '1')?>,
                   <?php echo reclamos($f1,$f2,$conexion,$area=1)?>,                   
                   <?php echo pedidosEntregado($f1,$f2,$conexion,$area=1)?>
                ]
                },
            ]

        }
        //ctx.update();
        //ctx.destroy();
    }); 


</script>

<!-- Completo -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica2").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Generación de OC's", "Recepción de OC's", "Reclamaciones" , "Pedidos Entregados"],
            datasets:[
                {
                label: "Compras",
                backgroundColor:[ 'rgba(58, 56, 54, 1)'],
                data: [
                    <?php echo dias($conexion,'FechaAdmin', 'FechaRegOC', $f1, $f2, 'upedido', 'uordencompra', 'Comp', '2', '1')?>, 
                    <?php echo oc($conexion, $f1, $f2,'2','2')?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=2)?>, 
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=2)?>
                ]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<!-- Completo -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica3").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Pedidos Entregados"],
            datasets:[
                {
                label: "Logística",
                backgroundColor:[ 'rgba(177, 189, 191, 1)'],
                data: [<?php echo pedidosEntregado($f1,$f2,$conexion,$area=3)?>
            ]
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
                label: "Imagen",
                backgroundColor:[ 'rgba(136, 155, 155, 1)'],
                data: [
                    <?php echo dias($conexion, 'SDeFeSol', 'SDeFeEnvio', $f1, $f2, 'solicituddetalle', null, 'IC', '4', '1')?>,
                    8,
                    <?php echo dias($conexion, 'PerEnvioPrendas', 'PerDateR', $f1, $f2, 'upersonalizacion', null, 'Procesos', '4', '3')?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=4)?>, 
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=4)?>
            ]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<!-- Completo -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica5").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Empaque" , "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Empaque",
                backgroundColor:[ 'rgba(71, 104, 101, 1)'],
                data: [
                    <?php echo dias($conexion,'FechaEmpR', 'FechaProcesos', $f1, $f2, 'uempaque', 'upedido', 'Emp', '5', '1')?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=5)?>, 
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=5)?>
                ]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<!-- Completo -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica6").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Pedidos Registrados", "Regresos a Asesores" , "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Backoffice",
                backgroundColor:[ 'rgba(166, 65, 56, 1)'],
                data: [
                    <?php echo dias($conexion,'FechaEnvioBCK', 'FechaRegistro', $f1, $f2, 'upedido', null, 'Registro-Backoffice', '6', '1')?>,
                    <?php echo rechazos($conexion, $f1, $f2)?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=6)?>,
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=6)?>
                ]
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
                label: "Almacen",
                backgroundColor:['rgba(208, 208, 208, 1)',],
                data: [
                    <?php echo (dias($conexion,'FechaOCReal', 'OC1aRevFe', $f1, $f2, 'uordencompra', null, 'Rev1', '8', '1')+ dias($conexion,'FechaOCReal', 'OC2aRevFe', $f1, $f2, 'uordencompra', null, 'Rev2', '8', '2'))?>,
                    <?php echo oc($conexion, $f1, $f2,'2','2')?>,
                    <?php echo recoleccion($conexion,$f1,$f2)?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=7)?>,
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=7)?>
                ]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<!-- Completo -->
<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica8").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Rev. Maquilas #1" , "Rev. Maquilas #2", "Defectos de calidad","Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Calidad",
                backgroundColor:[ 'rgba(114, 114, 115, 1)'],
                data: [
                    <?php echo dias($conexion,'FechaOCReal', 'OC1aRevFe', $f1, $f2, 'uordencompra', null, 'Rev1', '8', '1')?>,
                    <?php echo dias($conexion,'FechaOCReal', 'OC2aRevFe', $f1, $f2, 'uordencompra', null, 'Rev2', '8', '2')?>,
                    <?php echo defectos($conexion, $f1, $f2,'8', '3');?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=8)?>,
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=8)?>
                ]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>

<script>
    //let miCanvas=document.getElementById("MiGrafica").getContext("2d");
    var ctx = document.getElementById("MiGrafica9").getContext("2d");

    var chart = new Chart(ctx,{
        type: "bar",
        data:{
            labels:["Generación de OC's" , "Recepción de OC's", "Reclamaciones", "Pedidos Entregados"],
            datasets:[
                {
                label: "Producción",
                backgroundColor:[ 'rgba(177, 189, 191, 1)'],
                data: [
                    <?php echo dias($conexion,'FechaAdmin', 'FechaRegOC', $f1, $f2, 'upedido', 'uordencompra', 'Comp', '11', '1')?>, 
                    <?php echo oc($conexion, $f1, $f2,'11','2')?>,
                    <?php echo reclamos($f1,$f2,$conexion,$area=2)?>, 
                    <?php echo pedidosEntregado($f1,$f2,$conexion,$area=2)?>
                ]
                }
            ]
        }
        //ctx.update();
        //ctx.destroy();
    }); 
</script>






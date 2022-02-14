<?php 
echo '<h1 align="center"> Indicadores </h1>';
  include("../conexion.php");

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

  $query = "SELECT FechaAdmin, FechaComp, DATEDIFF (FechaComp, FechaAdmin) from upedido WHERE FechaAdmin BETWEEN '$f1' AND '$f2'";

  $query2 = "SELECT FechaComp, FechaLog, DATEDIFF (FechaLog, FechaComp) from upedido WHERE FechaComp BETWEEN '$f1' AND '$f2'";

  $query3 = "SELECT FechaComp, FechaLog, DATEDIFF (FechaLog, FechaComp) from upedido WHERE FechaComp BETWEEN '$f1' AND '$f2'";

 /*  $ind = "SELECT AREA FROM configuracionind WHERE AREA = 'Administracion'";
  $resul = $conexion->query($ind);
  echo $resul; */

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
  ?>
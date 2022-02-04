  
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  <title>Hello, world!</title>
  </head>
  <body>
  <!-- Todos los registros -->
  <!-- Registros por Fecha -->
  <div class="container mt-5">
  <table border="1">
  <thead>
  <tr>
  <th colspan="9"><center><h1>Reg. por Fecha</h1></center> </th>
  </tr>
  </thead>
  <tbody>
  
  <tr>
  <td align="center">ID</td>
  <td align="center">Fecha</td>
  <td align="center">Descripcion</td>
  <td align="center">Status</td>
  
  </tr>
  
  
  <?php
  include("../conexion.php");
  
  $f1 = $_POST['f1'];
  $f2 = $_POST['f2'];
  
  $query= "SELECT * FROM fechas WHERE fechain BETWEEN '$f1' AND '$f2'";
  $resultado= $conexion->query($query);
  
  while($row=$resultado->fetch_assoc()){
    ?>
    
    <tr>
    <td align="center"><?php echo $row['id_fecha'] ?></td>
    <td align="center"><?php echo $row['fechain'] ?></td>
    <td align="center"><?php echo $row['dato'] ?></td>
    <td align="center"><?php echo $row['ent_tiempo'] ?></td>
    
    </tr>
    
    
    <?php
    
  }
  
  ?>
  </tbody>
  
  </table>
  
  <?php 
  if($resultado)
  {
    $cuentafila = mysqli_num_rows($resultado);
    echo 'Total: '.$cuentafila.'<br>';
    
    $query2= "SELECT * FROM fechas WHERE fechain BETWEEN '$f1' AND '$f2' AND ent_tiempo='no'";
    
    $resultado2= $conexion->query($query2);
    $cuentafila2 = mysqli_num_rows($resultado2);
    echo 'Total no entregados a tiempo: '.$cuentafila2.'<br>';
    
    $query3= "SELECT * FROM fechas WHERE fechain BETWEEN '$f1' AND '$f2' AND ent_tiempo='si'";
    
    $resultado3= $conexion->query($query3);
    $cuentafila3 = mysqli_num_rows($resultado3);
    echo 'Total entregados a tiempo: '.$cuentafila3.'<br>';
    
    $prom = ($cuentafila3*10)/$cuentafila;
    echo 'Promedio general: '.$prom;
  }
  ?>
  
  <?php 
  
  
  ?>
  </div>
  
  <!-- Registro no a tiempo -->
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  <script>
  var trace1 = {
    x: [1, 2, 3, 4],
    y: [10, 15, 13, 17],
    type: 'scatter'
  };
  
  var trace2 = {
    x: [1, 2, 3, 4],
    y: [16, 5, 11, 9],
    type: 'scatter'
  };
  
  var data = [trace1, trace2];
  
  Plotly.newPlot('graficaLineal', data);
  </script>
  </body> 
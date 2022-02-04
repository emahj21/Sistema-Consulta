<?php

session_start();
if (isset($_SESSION['tiempo'])) {

  //Tiempo en segundos para dar vida a la sesión.
  $inactivo = 6000; //1min en este caso.

  //Calculamos tiempo de vida inactivo.
  $vida_session = time() - $_SESSION['tiempo'];

  //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
  if ($vida_session > $inactivo) {
    //Removemos sesión.
    session_unset();
    //Destruimos sesión.
    session_destroy();
    //Redirigimos pagina.
    header("Location: log.html");

    exit();
  } else {  // si no ha caducado la sesion, actualizamos
    $_SESSION['tiempo'] = time();
  }
} else {
  //Activamos sesion tiempo.
  $_SESSION['tiempo'] = time();
}


$varsesion = $_SESSION['correoelectronico'];
if ($varsesion == null || $varsesion = '') {

  header("Location: pag/denied.html");
  die();
}

?>

<?php 
  $conexion = new mysqli("localhost", "root", "", "bd_uni");
?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="sweetalert2.min.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

  <link rel="stylesheet" src="libs/morris.css">
  <script src="libs/morris.min.js" charset="utf-8"></script>


  <!-- <link rel="stylesheet" href="css/style.css"> -->

  <title>Document</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://sp-ao.shortpixel.ai/client/to_webp,q_lossy,ret_img,w_1024/https://unibrand.com.mx/wp-content/uploads/2020/02/icono-1024x612.png" height="30" class="d-inline-block align-top" alt="">
        <span style="font-size:23px;">Unibrand</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION["correoelectronico"]; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <form class="col-4" action="pag/con_fecha.php" method="POST" target="_blank">
        <div class="row">
          <label class="col-12" for="">Fecha Inicial</label>
          <input type="date" name="f1" >
          <label class="col-12" for="">Fecha Final</label>
          <input type="date" name="f2"  >
          <input type="submit" value="Consultar" >
        </div>
      </form>

  
      <div class="col-6">
        <!--consulta-->
        <div class="row">

          <div class="col-md-6">
            <h2>Grafica de linea</h2>
            <hr>
            <div id="myfirstchart"></div>
          </div>

          <div class="col-md-6">
            <h2>Grafica de area</h2>
            <hr>
          </div>

        </div>
      </div>


    </div>
  </div>

  
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

  <!-- SweetAlert 2 -->
  <script src="js/lineas.js" charset="utf-8"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/chart.esm.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/helpers.esm.min.js"></script>


  <script>
    Swal.fire(
      'Bienvenido',
      'Has iniciado sesión',
      'OK'
    )
  </script>

   <script>
     const ctx = document.getElementById('myChart');
      const myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
              datasets: [{
                  label: '# of Votes',
                  data: [12, 19, 3, 5, 2, 3],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
     function CargaDatos()
     {

     }
   </script>
</body>

</html>
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
<!-- Animations-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="icon" href="images/ico.ico">

<!--<link rel="stylesheet" href="css/style.css"> -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/funciones.js"></script>


<title>Inicio</title>
</head>
<style>
.dropdown-item:active {
  background-color: #EF172F;
}
</style>

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
<div class="container-fluid" style="margin: 20px 0 0 20px;">
<div class="container row ">
<form class="col-4" action="graf.php" method="POST" target="_blank">
<div class="row">
<label class="col-12" for="">Fecha Inicial</label>
<input type="date" name="f1" required>
<label class="col-12" for="">Fecha Final</label>
<input type="date" name="f2" required>
<button type="submit" style="margin-top: 30px; border-radius: 50px;" class=" col-12 btn btn-outline-secondary" >Consultar</button>
<a href="#" onclick="edicion()">Mostrar</a>
</div>

</form>





<div class="col-sm-8">
<div class="row">
<div class="panel panel-heading">
Indicadores
</div>
</div>
<div class="row">
<!--consulta-->
<div id="derecha"></div>
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
Swal.fire({
  icon: 'success',
  title: 'Bienvenido',
  text: 'Has iniciado sesión',
  color: '#fff',
  background: '#545454',
  position: 'top-end',
  showConfirmButton: false,
  
  timer: '3000',
  toast: true,
  hideClass: {
    popup: 'animate__animated  animate__backOutUp'
  }
})
</script>

<script type="text/javascript">
function edicion(){
  $('#derecha').load('graf.php')/*aqui no se como cargar la pagina en el div derecho*/ 
}
</script>

</body>

</html>
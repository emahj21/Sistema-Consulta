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
    header("Location: ../log.html");
    
    exit();
  } else {  // si no ha caducado la sesion, actualizamos
    $_SESSION['tiempo'] = time();
  }
} else {
  //Activamos sesion tiempo.
  $_SESSION['tiempo'] = time();
}


$varsesion = $_SESSION['UserMail'];
if ($varsesion == null || $varsesion = '') {
  
  header("Location: pag/denied.html");
  die();
}

?>

<?php
$conexion = new mysqli("localhost", "root", "", "unibrandprod");

?>
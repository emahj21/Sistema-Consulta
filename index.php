<?php

	session_start();
  if(isset($_SESSION['tiempo']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 6000;//1min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($vida_session > $inactivo)
        {
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
  if($varsesion == null || $varsesion= '')
  {
    
    header("Location: pag/denied.html");
    die();
  }
   
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
    

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    
    <title>Document</title>
</head>
<body>

      <!-- Image and text -->
<!-- <nav class="navbar navbar-light bg-light">
    <div class="col-md-4">
      <img src="https://sp-ao.shortpixel.ai/client/to_webp,q_lossy,ret_img,w_1024/https://unibrand.com.mx/wp-content/uploads/2020/02/icono-1024x612.png" height="30" style="margin-left: 20px; "  class="d-inline-block align-top" alt="">
      <span style="">Unibrand</span> 
    </div>
    <div class="col-md-4">
      <div class="row justify-content-end">
        <div class="col-sm-6">
          <label style="position: absolute;transform: translatey(123%); font-weight: bold;"><?php echo $_SESSION["correoelectronico"];?></label>
        </div>
        <div class="col-sm-4" style="margin-right: 20px;">
          <div class="row">
            <span class="material-icons text-center justify-content-center">power_settings_new</span>
            <a class="btn" href="cerrar_sesion.php">Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>

  
  </a>
</nav> -->


    

      

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

  <!-- SweetAlert 2 -->  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>


  <script>
    Swal.fire(
  'Bienvenido',
  'Has iniciado sesión',
  'OK'
  )
  </script>

</body>
</html>
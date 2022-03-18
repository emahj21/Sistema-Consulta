<?php
 include("pag/control_sesion.php");
?>


<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/ico.ico">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="sweetalert2.min.css">
<!-- Animations-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">



<!--<link rel="stylesheet" href="css/style.css"> -->

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<!-- <script src="js/jquery-3.6.0.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>


<title>Inicio</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" id="1">
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
<?php echo $_SESSION["UserMail"]; ?>
</a>
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="pag/cerrar_sesion.php">Cerrar Sesión</a></li>
</ul>
</li>
</ul>
</div>
</div>
</nav>

<!-- Formulario -->
<div class="container-fluid" style="padding: 20px;">
<div class="container row ">
  <!-- Formulario -->
<form class="col-4 mt-5" action="" >
<div class="row">
<label class="col-12" for="">Fecha Inicial</label>
<input type="date" id="f1" required value='2021-12-01'">
<label class="col-12" for="">Fecha Final</label>
<input type="date" id="f2" required value='2021-12-15'">
<button type="button" style="margin-top: 30px; border-radius: 50px;" class=" col-12 btn btn-outline-secondary" id="Enviar">Consultar</button>
</div>
</form>





<div class="col-sm-8">
<div class="row">
<div class="panel panel-heading">

</div>
</div>
<div class="row">
<!--consulta-->
<div id="respuesta">
    
</div>




</div>


</div>

</div>

<div class="goup" >
<a href="#1"><span class="material-icons" style="font-size: 40px; color: #fff;">
arrow_upward
</span></a>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->

<!-- SweetAlert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/ajax.js"></script>
<script src="js/filtro.js"></script>



<script>
Swal.fire({
  icon: 'success',
  title: 'Bienvenido' ,
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
});
</script>



<script> 
  $('#Ver').click(function(){
      var Fechain=document.getElementById('f1').value;
      var Fechafin=document.getElementById('f2').value;

      var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

      $.ajax({
        url: 'administracion.php',
        type: 'POST',
        data: ruta,
      })

      .done(function(res){
        $('#con').html(res)
        //$('#f1').val('');
        //$('#f2').val('');
      })

      .fail(function(){
        console.log("error");
      })
      .always(function(){
        console.log("complete");
      })
  });  

</script>

<script>
  $(document).ready(function(){
	$('.goup').hide();
	$('.goup').click(function(){
		$('body,html').animate({
			scrollTop:0
		},1000)
	});
	$(window).scroll(function () {
		if ($(this).scrollTop() &gt; 200) {
			$('.goup').fadeIn();
		}
		else {
			$('.goup').fadeOut();
		}
	});
});
</script>
</body>

</html>

<?php

	$correoelectronico = $_POST['correoelectronico'];
    $usercontra = $_POST['usercontra'];
    session_start();

    $_SESSION['correoelectronico'] = $correoelectronico;

	$conn = mysqli_connect("localhost","root","","bd_uni");

	$consulta =  "SELECT * FROM usuario WHERE correoelectronico='$correoelectronico' AND usercontra = '$usercontra' AND (usertipo='LOG' OR  usertipo='DIR')";

	$resultado = mysqli_query($conn, $consulta);

	$filas=mysqli_num_rows($resultado);

	if($filas>0)
	{
        
		header("Location: index.php");
	}else
	{
        echo'<script type="text/javascript">
    alert("Usuario o contraseña inválido");
    window.location.href="log.html";
    </script>';
    
	}

	mysqli_free_result($resultado);
	mysqli_close($conn);
?>

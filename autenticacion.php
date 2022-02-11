
<?php

	$UserMail = $_POST['UserMail'];
    $Usercontra = $_POST['Usercontra'];
    session_start();

    $_SESSION['UserMail'] = $UserMail;

	$conn = mysqli_connect("localhost","root","","unibrandprod");

	$consulta =  "SELECT * FROM usuario WHERE (UserMail='$UserMail' AND Usercontra = '$Usercontra' ) AND (Usertipo='LOG' OR  Usertipo='DIR')";

	$resultado = mysqli_query($conn, $consulta);

	$filas=mysqli_num_rows($resultado);

	if($filas>0 && ($UserMail=='comercial@unibrand.com.mx' && $Usercontra=='direccion') || ($UserMail=='logistica@unibrand.com.mx' && $Usercontra=='181217') || ($UserMail=='admon@unibrand.com.mx' && $Usercontra=='290800') )
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

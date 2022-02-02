
<?php
	$inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    //$usercontra = $_POST['usercontra'];
    session_start();

    //$_SESSION['correoelectronico'] = $correoelectronico;

	$conn = mysqli_connect("localhost","root","","bd_uni");

	$consulta =  "SELECT * FROM pruebafechas WHERE fechainicio BETWEEN '$inicio' AND '$fin'";

	$resultado = mysqli_query($conn, $consulta);

	$filas=mysqli_num_rows($resultado);

	if($filas>0)
	{
        
		echo('Consulta exitosa');
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

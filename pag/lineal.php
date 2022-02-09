<?php 
require_once('../conexion.php');

/* $f1 = $_POST['f1'];
$f2 = $_POST['f2'];
 */
$sql= "SELECT id_fecha, ent_tiempo FROM fechas ";
$result= mysqli_query($conexion, $sql);

$valoresY=array();
$valoresX=array();

while($ver=mysqli_fetch_row($result))
{
    $valoresY[] = $ver[1];
    $valoresX[] = $ver[0];
}

$datosX=json_encode($valoresX);
$datosY=json_encode($valoresY);

?>

<div id="graficaLineal"></div>

<script type="text/javascript">
function crearCadenaLineal(json)
{
    var parsed = JSON.parse(json);
    var arr = [];
    for(var x in parsed)
    {
        arr.push(parsed[x]);
    }
    return arr;
}
</script>

<script type="text/javascript">

datosX=crearCadenaLineal('<?php echo $datosX?>');
datosY=crearCadenaLineal('<?php echo $datosY?>');

var trace1 = {
    x: datosX,
    y: datosY,
    type: 'scatter'
};



var data = [trace1];

Plotly.newPlot('graficaLineal', data);

</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#cargaLineal').load('pag/lineal.php');
      $('#cargaBarras').load('pag/barras.php');
    });
  </script>
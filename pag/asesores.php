

<?php 

include("../conexion.php");


$f1 = $_POST['Fein'];
$f2 = $_POST['Fefin'];
//---------- Variables ----------

  $contador_dias = 0;
  $a_tiempo=0;
  $integer2 = 0;
  $diaFestivo=[];
  $j=0;
  
  $query="SELECT FechaAdmin, NoRechazoImg, NoRechazoCom, NoRechazoAdm FROM upedido WHERE FechaAdmin BETWEEN '$f1' AND '$f2';";
  $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='Admin'";
  $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '6' AND IndId='3';"; 
  //echo $query.'<br>';
  //echo $dia.'<br>';
  //echo $peso.'<br>';
  //---------- Variables ----------
  $resultado = $conexion->query($query);
  $resultado2 = $conexion->query($dia);
  $resultadoPeso = $conexion->query($peso);
  
  $cont_rechazos=0;
  if($resultado){
      $totalPedidos=mysqli_num_rows($resultado);  
  }
  //echo "Total de pedidos: ";
  //echo $totalPedidos."<br>";
  while($row2=$resultado2->fetch_assoc()){  
      $val = intval($row2['Diastotal']);
  }
  //echo "Dias que tarda el proceso: ";
  //echo $val."<br>";
  while($row3 = $resultadoPeso->fetch_assoc()){
      $peso = intval($row3['PesoPuntos']);
  }
  //echo "Peso Puntos: ";
  //echo $peso.'<br>';
  while($row = $resultado->fetch_assoc()){
      if($row['NoRechazoAdm']!=0 || $row['NoRechazoCom']!=0 ||$row['NoRechazoImg']!=0){
          $cont_rechazos++;
          $cadena[$j] = '<h5>&#10060;</h5>';
          $j++;
      }else
      {
        $cadena[$j] = '<h5>&#x2714;</h5>';
        $j++;
      }
  }
  $buenos=$totalPedidos-$cont_rechazos;
  //echo "Numero de Rechazos: ";
  //echo $cont_rechazos.'<br>';
  $val_Total=($buenos*$peso)/$totalPedidos;
  //Recorrido Funcion
  //$val_final = ($a_tiempo*$peso)/$totalPedidos;
  //return $val_final;




?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="../images/ico.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
   

    <title>Administración</title>
  </head>
  <body class="m-0 ">
  
    
    <div class="container" id="tablas">
      <div style="text-align: center;">
        <select id="selectCategory" align="center">
          <option value="">Selecciona Filtro</option>
          <option value="">Todos</option>
          <option value="&#x2714">&#x2714;</option>
          <option value="&#10060">&#10060;</option>
        </select>
      </div>
        <div class="row">
   <table  class="table" width="" >
                
                    <thead  class="thead-dark">
                    <tr>
                        <td>Nombre del Cliente</td>
                        <td>Número de Pedido</td>
                        <td>Fecha de Inicio</td>
                        <td>Rechazos</td>
                        <td width="20">Estatus</td>
                    </tr>
                    </thead>
                    <tbody  id="tabla">
                    <?php
                        include("../conexion.php");
                        

                        /* $query= "SELECT FechaRegistro, FechaAdmin, Idpedido, PeFeReqCli, FechaLiberacion, DAYOFWEEK(FechaRegistro), DATEDIFF(FechaAdmin, FechaRegistro) from upedido WHERE FechaRegistro BETWEEN '$f1' AND '$f2'  AND DAYOFWEEK(FechaRegistro) IN (2,3,4,5,6)"; */
                        $query = "SELECT upedido.Idpedido,  upedido.FechaAdmin, upedido.NoRechazoAdm, upedido.NoRechazoCom,
                        upedido.NoRechazoImg, upedido.idcontacto, contacto.IdContacto, ucliente.IDCliente, ucliente.CRazonSocial FROM upedido 
                        INNER JOIN contacto ON contacto.IdContacto = upedido.idcontacto 
                        INNER JOIN ucliente ON  contacto.IDCliente = ucliente.IDCliente 
                        WHERE FechaAdmin BETWEEN '$f1' AND '$f2'";


                        $resultado= $conexion->query($query);
                        $i=0;
                        while($row=$resultado->fetch_assoc()){
                    ?>

                    <tr>
                        <td><?php echo $row['CRazonSocial'] ?></td>
                        <td><?php echo $row['Idpedido'] ?></td> 
                        <td><?php echo $row['FechaAdmin'] ?></td>
                        <td><?php echo intval($row['NoRechazoAdm']+$row['NoRechazoCom']+$row['NoRechazoImg'])?></td> 
                        <td><?php echo $cadena[$i];$i++ ?></td>
                      
                    </tr>

                    <?php
                        }
                        ?>
                </tbody>
            </table>
            <button class="btn" style="border-color: #000; " onclick="ocultar();">Ocultar</button>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function ocultar()
        {
          {
          var x = document.getElementById("tablas");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
        }
        }
    </script>

    <script>
      $("#selectCategory").change(function () {
    if(this.value != "Todos")
      {
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $("#tabla").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();
    
    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
      }
    }).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
    }).css({
    "color": "#C0C0C0"
    });
    </script>
  </body>
</html>
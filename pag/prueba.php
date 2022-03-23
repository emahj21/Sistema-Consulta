<?php

include('../conexion.php');

$f1 = '2021-01-01';
$f2 = '2021-01-31';

$FechaF = 'FechaAdmin';
$FechaI = 'FechaRegOC';
$tabla = 'uordencompra';
$tabla2 = 'upedido';
$proc = 'Comp';
$cadena=[];
$j=0;
//---------- Variables ----------

    /* $query = "SELECT ".$tabla.".".$FechaI.", ".$tabla2.".".$FechaF.", DATEDIFF(".$tabla2.".".$FechaF.", ".$tabla.".".$FechaI.") from ".$tabla.",".$tabla2." WHERE ".$tabla.".".$FechaI." BETWEEN '$f1' AND '$f2'"; */
    $query = "SELECT ".$tabla.".".$FechaI.", ".$tabla2.".".$FechaF.", DATEDIFF(".$tabla2.".".$FechaF.", ".$tabla.".".$FechaI. ")FROM ".$tabla." INNER JOIN ".$tabla2." ON ".$tabla.".Idpedido = ".$tabla2.".Idpedido WHERE ".$tabla.".".$FechaI." BETWEEN '$f1' AND '$f2';";

$festivo = "SELECT DFFecha from diasfest";
$dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
//$peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '$ind' AND IndId='$ind2';"; 

$resultado = $conexion->query($query);
$resultado1 = $conexion->query($festivo);
$resultado2 = $conexion->query($dia);
//$resultadoPeso = $conexion->query($peso);

//---------- Variables ----------
$contador_dias = 0;
$a_tiempo=0;
$integer2 = 0;
$diaFestivo=[];
if($resultado){
    $totalPedidos=mysqli_num_rows($resultado);  
}
//Recorrido total días
while($row2=$resultado2->fetch_assoc()){  
    $val = intval($row2['Diastotal']);
}


//Recorrido Puntos
/* while($row3 = $resultadoPeso->fetch_assoc()){
    $peso = intval($row3['PesoPuntos']);
} */
//Recorrido Fechas
while($row1=$resultado1->fetch_assoc()){

    array_push($diaFestivo,$row1['DFFecha']);
}

    while($row=$resultado->fetch_assoc()){
        if($tabla2==null){
          if($row[$FechaF] == '1000-01-01 00:00:00' || $row[$FechaF] == '1000-01-01')
          {
             $aux = date('d-m-Y');
             $row[$FechaF] = $aux;
  
             $date1 = new DateTime($row[$FechaI]);
             $date2 = new DateTime($row[$FechaF]);
             $diff = $date1->diff($date2);
  
             $integer2 = intval($diff->days);
          }else
          {
  
            $integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);
          }
        }else{
            $integer2 = intval($row['DATEDIFF('.$tabla2.'.'.$FechaF.', '.$tabla.'.'.$FechaI.')']);
  
        }
        for($i=0; $i<$integer2; $i++){    
            //if( ($row[$FechaI] != $row1['DFFecha'])){   
            if( ($row[$FechaI] != $diaFestivo[$i])){   
                $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                $row[$FechaI] = $aux;
                
                if(date("w",strtotime($row[$FechaI])) != 0){
                    $contador_dias++;
                }       
            }else{
                $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                $row[$FechaI] = $aux;
            }
            
        }
        
        if($contador_dias <= $val){
            $a_tiempo++;
            $cadena[$j] = '<h5>&#x2714;</h5>';
            echo $cadena[$j];
            $j++;
        }  else
        {
            $cadena[$j] = '<h5>&#10060;</h5>';
            echo $cadena[$j];
            $j++;
        }
        $contador_dias = 0;
    }
?>
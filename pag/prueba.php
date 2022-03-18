<?php
include('../conexion.php');
 $f1 = '2021-12-15';
  $f2 = '2021-12-23';
  function recoleccion($conexion,$f1,$f2){
    $query = "SELECT FechaOCReal,IdTipoOC,FechaVoBo, FechaEnvioMaq, DATEDIFF(FechaVoBo, FechaOCReal), DATEDIFF(FechaEnvioMaq, FechaOCReal) FROM uordencompra WHERE FechaOCReal BETWEEN '$f1' AND '$f2'";
    $festivo = "SELECT DFFecha from diasfest";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='Alm'";
    $peso = "SELECT PesoPuntos FROM configuracionindindicadores WHERE ConId = '7' AND IndId='3';"; 
   // echo $query.'<br>';
    //echo $festivo.'<br>';
    //echo $dia.'<br>';
    //
    $resultado = $conexion->query($query);
    $resultado1 = $conexion->query($festivo);
    $resultado2 = $conexion->query($dia);
    $resultadoPeso = $conexion->query($peso);
    $contador_dias=0;
    $a_tiempo=0;
    $totalPedidos;
    
    //
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
    }
   // echo $totalPedidos."<br>";
    while($row2=$resultado2->fetch_assoc()){  
        $val = intval($row2['Diastotal']);
    }
  //echo $val."<br>";
    while($row3 = $resultadoPeso->fetch_assoc()){
        $peso = intval($row3['PesoPuntos']);
}

while($row=$resultado->fetch_assoc()){  
}

if($row['IdTipoOC']==='2' || $row['IdTipoOC']==='3' || $row['IdTipoOC']==='10'){
    if($row['FechaVoBo']==='1000-01-01'){
        $aux = date('d-m-Y');
        $row['FechaVobo'] = $aux;        
        $date1 = new DateTime($row['FechaOCReal']);
        $date2 = new DateTime($row['FechaVoBo']);
        $diff = $date1->diff($date2);
        $integer2 = intval($diff->days);
    }else{
        $integer2=intval($row['DATEDIFF(FechaVoBo, FechaOCReal)']);
    }
}else{
    if($row['FechaEnvioMaq']==='1000-01-01'){
        $aux = date('d-m-Y');
        $row['FechaVobo'] = $aux;        
        $date1 = new DateTime($row['FechaOCReal']);
        $date2 = new DateTime($row['FechaEnvioMaq']);
        $diff = $date1->diff($date2);
        $integer2 = intval($diff->days);
    }else{
        $integer2=intval($row['DATEDIFF(FechaEnvioMaq, FechaOCReal)']);
    }
}
for($i=0;$i<$integer2;$i++){
    if( ($row['FechaOCReal'] != $row1['DFFecha'])){   
        $aux = date("d-m-Y",strtotime($row['FechaOCReal']."+ 1 days"));
        $row['FechaOCReal'] = $aux;
        
        if(date("w",strtotime($row['FechaOCReal'])) != 0){
            $contador_dias++;
        }       
    }else{
        $aux = date("d-m-Y",strtotime($row['FechaOCReal']."+ 1 days"));
        $row['FechaOCReal'] = $aux;
    }
}
if($contador_dias <= $val){
    $a_tiempo++;
  
$contador_dias = 0;
}


//echo 'Pedidos a tiempo: ';
$val_final = ($a_tiempo*$peso)/$totalPedidos;
//echo $a_tiempo.'<br>';
//echo 'Valor final: ';
//echo $val_final;
return $val_final;
}

echo recoleccion($conexion,$f1,$f2);



?>



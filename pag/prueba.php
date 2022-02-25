<?php


include("../conexion.php");

$queryAreas="SELECT Area FROM configuracionind";
$consultaAreas=mysqli_query($conexion,$queryAreas);
$tabla_areas=[];
$i=0;  
while($row = mysqli_fetch_array($consultaAreas)){
      $tabla_areas[$i]['nombre']=$row['Area'];
      $i++;
}


/* function dias($conexion,$FechaI,$FechaF,$f1,$f2, $tabla,$tabla2=null, $proc){
    $fechaBCK="SELECT FechaEnvioBCK FROM upedidos";
    $resultadoBCK= $conexion->query($fechaBCK);
    
    while($row2=$resultadoBCK->fetch_assoc()){
        if($row2['FechaEnvioBCK']!='1000-01-01 00:00:00'){

        }
    }
   
    
    
    //---------- Consultas ----------
    if($tabla2=null){
        $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    }else{
        $query = "SELECT ".$FechaI.".".$tabla.", ".$FechaF.".".$tabla2.", DATEDIFF(".$FechaF.".".$tabla.", ".$FechaI.".".$tabla2.") from ".$tabla.",".$tabla2."WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    }

} */



function dias($conexion,$FechaI,$FechaF,$f1,$f2, $tabla,$proc){
    //---------- Consultas ----------
    $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    $festivo = "SELECT DFFecha from diasfest";
    $dia = "SELECT Proceso, Diastotal from uprocesos WHERE Proceso='$proc'";
    
    $resultado = $conexion->query($query);
    $resultado1 = $conexion->query($festivo);
    $resultado2 = $conexion->query($dia);
    
    //---------- Variables ----------
    $aux;
    $contador_dias = 0;
    $a_tiempo=0;
  
    /* Total Pedidos */
    if($resultado){
        $totalPedidos=mysqli_num_rows($resultado);  
        //echo intval($totalPedidos);
    }
    while($row2=$resultado2->fetch_assoc())
    {  
      $val = intval($row2['Diastotal']);
    }
    while($row1=$resultado1->fetch_assoc()){
    }
    while($row=$resultado->fetch_assoc())
    {
        /* Si la fecha es default */
        $integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);
        if($integer2==0){
            echo "Del ".date("d-m-Y",strtotime($row[$FechaI]));
            echo " al ".date("d-m-Y",strtotime($row[$FechaF])).'<br>';
        } 
        for($i=0; $i<$integer2; $i++){    
            if( ($row[$FechaI] != $row1['DFFecha'])){   
                $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                $row[$FechaI] = $aux;
                echo " al ".date("d-m-Y",strtotime($row[$FechaI])).'<br>';
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
        }  
        $contador_dias = 0;
    }
  echo $a_tiempo;
  $val_final = ($a_tiempo*20)/$totalPedidos;

  echo $val_final;
 
  return $val_final;


}

//oc($conexion, '2021-12-01' , '2021-12-15', '2', '2');
/*echo'<h1>FechaRegistro - FechaAdmin</h1>';
dias($conexion,'FechaRegistro','FechaAdmin','2021-12-01','2021-12-15', 'upedido', 'Admin');
 echo'<h1>FechaEmp - Fecha Liberacion</h1>';
dias($conexion,'FechaEmp','FechaLiberacion','2021-12-01','2021-12-15','upedido');
echo'<h1>FechaEmp - FechaLiberacion</h1>';
dias($conexion,'FechaEmp','FechaLiberacion','2021-05-01','2021-05-20','upedido');
echo'<h1>FechaRegistro - FechaEnvioBCK</h1>';
dias($conexion,'FechaRegistro','FechaEnvioBCK','2021-12-01','2021-12-15','upedido');
echo'<h1>Default</h1>';
dias($conexion,'FechaRegistro','FechaAdmin','2021-01-01','2021-03-01','upedido'); */
/*dias($conexion,'FechaRegistro','FechaAdmin','2021-01-01','2021-03-01','upedido', 'Admin'); 
echo'<h1>Default</h1>';
dias($conexion,'FechaRegistro','FechaAdmin','2021-01-01','2021-03-01','upedido'); */
echo'<h1>Default</h1>';
//dias($conexion,'FechaRegOC','FechaAdmin','2021-01-01','2021-03-01','uordencompra',null,'Admin'); 
dias($conexion,'FechaRegistro','FechaAdmin','2021-12-01','2021-12-03', 'upedido', 'Admin');
?> 

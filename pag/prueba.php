<?php


include("../conexion.php");

function dias($conexion,$FechaI,$FechaF,$f1,$f2, $tabla){
    
    $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    $resultado = $conexion->query($query);
    
    
    $festivo = "SELECT DFFecha from diasfest";
    $resultado1 = $conexion->query($festivo);
    
    $aux;
    $contador_dias = 0;
    
    while($row1=$resultado1->fetch_assoc())
    {
    
    }
    
    while($row=$resultado->fetch_assoc())
    {
        //echo date("d-m-Y",strtotime($row['".$FechaI."']."+ 1 days")).'<br>';
        $integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);
        //echo $integer2.'<br>';
        
            if($integer2==0){
                echo "Del ".date("d-m-Y",strtotime($row[$FechaI]));
                echo " al ".date("d-m-Y",strtotime($row[$FechaF])).'<br>';
                
            }
            for($i=0; $i<$integer2; $i++)
           {
               echo "Del ".date("d-m-Y",strtotime($row[$FechaI]));     
               
               //if( ($row[$FechaI] != $row1['DFFecha']) || date("w",strtotime($row[$FechaI])) != 0)
               if( ($row[$FechaI] != $row1['DFFecha']))
               {       
                   $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                   $row[$FechaI] = $aux;
                   echo " al ".date("d-m-Y",strtotime($row[$FechaI])).'<br>';
                       
                       //if($i < $integer2-1 ){
                       if(date("w",strtotime($row[$FechaI])) != 0){
                           
                           $contador_dias++;
                           //fechas donde el iterador y el contador estan desfasados
                           //echo 'iteracion '.$i.'<br>';
                           //echo 'contador '.$contador_dias.'<br>';
                           
                       }else{
                           //Fechas donde la iteracion coincide con el contador
                           //echo 'iteracion '.$i.'<br>';
                           //echo 'contador '.$contador_dias.'<br>';
                       }
               }
               else
               {
                   $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                   $row[$FechaI] = $aux;
                  // echo date("d-m-Y",strtotime($aux)).'<br>';
               }
           }
        

        /* while($row[$FechaI] != $row[$FechaF]){
            echo date("d-m-Y",strtotime($row[$FechaI])).'<br>';     
            if($row[$FechaI] != $row1['DFFecha'] || date("w",strtotime($row[$FechaI]))!=0){
                
                $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                echo date("d-m-Y",strtotime($aux)).'<br>';
                $row[$FechaI] = $aux;
                $contador_dias++; 
            }
            else{
                    echo date("d-m-Y",strtotime($aux)).'<br>';
                    $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                    $row[$FechaI] = $aux;
            }
            //$row[$FechaI]=strtotime($row[$FechaI]."+ 1 days");
            break;
        } */
        
        echo 'El proceso tardó '.($contador_dias).' días'.'<br>'.'<br>';
        $contador_dias = 0;
        
    }
    
}


echo'<h1>FechaRegistro - FechaAdmin</h1>';
dias($conexion,'FechaRegistro','FechaAdmin','2021-12-01','2021-12-15', 'upedido');
echo'<h1>FechaEmp - Fecha Liberacion</h1>';
dias($conexion,'FechaEmp','FechaLiberacion','2021-12-01','2021-12-15','upedido');
echo'<h1>FechaEmp - FechaLiberacion</h1>';
dias($conexion,'FechaEmp','FechaLiberacion','2021-05-01','2021-05-20','upedido');
echo'<h1>FechaRegistro - FechaEnvioBCK</h1>';
dias($conexion,'FechaRegistro','FechaEnvioBCK','2021-12-01','2021-12-15','upedido');
?>
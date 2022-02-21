<?php


include("../conexion.php");

function dias($conexion,$FechaI,$FechaF,$f1,$f2, $tabla){
    
    $query = "SELECT ".$FechaI.", ".$FechaF.", DATEDIFF(".$FechaF.", ".$FechaI.") from ".$tabla." WHERE ".$FechaI." BETWEEN '$f1' AND '$f2'";
    $resultado = $conexion->query($query);
    
    
    $festivo = "SELECT DFFecha from diasfest";
    $resultado1 = $conexion->query($festivo);
    
    $aux;
    $contador_dias = 1;
    
    while($row1=$resultado1->fetch_assoc())
    {
    
    }
    
    
    while($row=$resultado->fetch_assoc())
    {

   
        //echo date("d-m-Y",strtotime($row['".$FechaI."']."+ 1 days")).'<br>';
        //$integer2 = intval($row['DATEDIFF('.$FechaF.', '.$FechaI.')']);
       // echo $integer2.'<br>';
        /* for($i=0; $i<=$integer2; $i++)
        {
            echo date("d-m-Y",strtotime($row[$FechaI])).'<br>';     
            if( ($row[$FechaI] != $row1['DFFecha']) || date("w",strtotime($row[$FechaI])) != 0)
            {
                    $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                    echo date("d-m-Y",strtotime($aux)).'<br>';
                    $row[$FechaI] = $aux;
                    if($contador_dias < $integer2 ){
    
                        $contador_dias++;
                    }
            }
            else
            {
                echo date("d-m-Y",strtotime($aux)).'<br>';
                $aux = date("d-m-Y",strtotime($row[$FechaI]."+ 1 days"));
                $row[$FechaI] = $aux;
            }
        } */
        while($row[$FechaI] <= $row[$FechaF]){
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
        }
        echo 'El proceso tardó '.($contador_dias).' días'.'<br>';
        $contador_dias = 0;
    }
    }



dias($conexion,'FechaRegistro','FechaAdmin','2021-12-07','2021-12-16', 'upedido');

echo'<h1>Otro query</h1>';

dias($conexion,'FechaEmp','FechaLiberacion','2021-12-01','2021-12-15','upedido');

?>
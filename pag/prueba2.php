<?php
    $fechaInicial = "2022/01/10";
    $fechaFinal = "20-01-2022";
    $contador_dias = 0;

    while ($fechaInicial != $fechaFinal) {

        echo date("d-m-Y",strtotime($fechaInicial)).'<br>';     

        if(date("w",strtotime($fechaInicial))!=0) {

            $aux = date("d-m-Y",strtotime($fechaInicial."+ 1 days"));

            echo date("d-m-Y",strtotime($aux)).'<br>';
            $fechaInicial = $aux;
            $contador_dias++; 

        } else {
            echo date("d-m-Y",strtotime($aux)).'<br>';

            $aux = date("d-m-Y",strtotime($fechaInicial."+ 1 days"));
            $fechaInicial = $aux;
        }
    }
    echo 'El proceso tardó '.($contador_dias).' días'.'<br>';
    $contador_dias = 0;

?>
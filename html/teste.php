<?php
// 6 numeros primos a partir do numero de entrada
    // $n = readline();
    // $numbers = array(); 
    // $i = 1;

    // while($i < 7){
    //     if($n % 2 != 0){
    //         $numbers[] += $n;
    //         $i++;
    //     }
    //     $n++;
    // }
   
    // foreach($numbers as $item){
    //     echo $item . "\n"; 
    // }

    //numero de tomadas a partir de 4 entradas

    $n1 = (int) readline();
    $n2 = (int) readline();
    $n3 = (int) readline();
    $n4 = (int) readline();
    $total = $n1 + $n2 + $n3 + $n4 - 3;
    echo $total . "\n";

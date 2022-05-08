<?php

function rupiah($angka){
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    echo $hasil_rupiah;
}

function persentase($value1, $value2){

    $value3 = $value1 - $value2;
    
    

    $persen = round(($value3 / $value1)*100);
    echo $persen . "%";
}




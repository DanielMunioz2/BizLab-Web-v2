<?php

session_start();

function obtenerDataIp($ip){

    $url = 'http://ip-api.com/json/'.$ip;

    $response = file_get_contents($url);

    $data = json_decode($response, true);
    
    if($data['status'] == 'success'){
        return $data;
    }else{
        return null;
    }

}

$ipUser = $_SERVER['REMOTE_ADDR'];

$resultadoIp = obtenerDataIp($ipUser);

if($resultadoIp !== null){

    $ipUser = $_SERVER['REMOTE_ADDR']; 

    // echo "Ip: ".$ipUser."\n"; 
    // echo "País: ".$resultadoIp["country"]."\n";
    // echo "Ciudad: ".$resultadoIp["city"]."\n";
    // echo "Latitud: ".$resultadoIp["lat"]."\n";

}else{

    $ipUser = "127.0.0.1";

}


?>
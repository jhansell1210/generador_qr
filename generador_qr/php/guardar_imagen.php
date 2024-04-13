<?php
    require_once 'conexion.php';
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nombre=$data['nombre'];
    $url=$data['url'];
    
   
    
    $guardar_qr=conexion();
    $guardar_qr=$guardar_qr->prepare("INSERT INTO imagen_qr (imagen_nombre,
    imagen_url) VALUES (:nombre, :url_)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":url_"=>$url
    ];

    $guardar_qr->execute($marcadores);

    if($guardar_qr->rowCount()==1){
        echo'<div class="notification is-info is-light">
            <strong> ¡QR REGISTRADO!!</strong> <br>
            EL QR SE REGISTRÓ CON EXITO
            </div>';
    }else{
        echo'<div class="notification is-danger is-light">
            <strong> ¡Ocurrio un problema inesperado!!</strong> <br>
            NO SE PUDO REGISTRAR EL QR, POR FAVOR INTENTE NUEVAMENTE!
            </div>';
    }
    $guardar_qr=null;
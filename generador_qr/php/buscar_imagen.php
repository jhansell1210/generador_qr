<?php
      function conexion(){
		$pdo = new PDO('mysql:host=localhost;dbname=qr', 'root', '');
		return $pdo;
	}
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nombre=$data['nombre']; 


    
    function buscarQR($nombre) {

        $guardar_qr=conexion();
        try {
            $consulta = $guardar_qr->prepare("SELECT * FROM imagen_qr WHERE imagen_nombre = :nombre");
            $consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $consulta->execute();
    
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
            return $usuario;
        } catch (PDOException $e) {
            echo "Error al buscar QR: " . $e->getMessage();
            return null;
        }
    }
    
     // Uso de la función buscarUsuarioPorId
     // ID del usuario a buscar

    $qrEncontrado = buscarQR($nombre);
    
    if ($qrEncontrado) {
        echo $qrEncontrado['imagen_url'];
    } else {
        echo "QR no encontrado";
        }
    ?>
    
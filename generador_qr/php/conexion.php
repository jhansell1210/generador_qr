<?php
   function conexion(){
		$pdo = new PDO('mysql:host=localhost;dbname=qr', 'root', '');
		return $pdo;
	}
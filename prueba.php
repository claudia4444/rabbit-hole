<?php
require "conexion.php";

$texto = "Curiosidad de prueba";
$imagen = "imagenes/prueba.jpg";

$stmt = $conexion->prepare("INSERT INTO curiosidades (texto, imagen) VALUES (?, ?)");
$stmt->bind_param("ss", $texto, $imagen);
$stmt->execute();

echo "Guardado con id: " . $conexion->insert_id;
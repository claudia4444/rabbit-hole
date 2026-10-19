<?php
header("Content-Type: text/plain; charset=utf-8");

require "conexion.php";

$datos = json_decode(file_get_contents("php://input"), true);

$texto = trim($datos["texto"] ?? "");
$semilla = $datos["semilla"] ?? "";

if ($texto === "" || $semilla === "") {
  http_response_code(400);
  echo "Faltan datos.";
  exit;
}

$urlImagen = "https://picsum.photos/seed/" . $semilla . "/400";
$contenidoImagen = file_get_contents($urlImagen);

if ($contenidoImagen === false) {
  http_response_code(500);
  echo "No se pudo descargar la imagen.";
  exit;
}

$nombreArchivo = "imagenes/" . $semilla . ".jpg";
file_put_contents($nombreArchivo, $contenidoImagen);

$stmt = $conexion->prepare("INSERT INTO curiosidades (texto, imagen) VALUES (?, ?)");
$stmt->bind_param("ss", $texto, $nombreArchivo);
$stmt->execute();

echo "Curiosidad guardada con id: " . $conexion->insert_id;
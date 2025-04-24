<?php
$dataFile = 'ordenes_produccion.json';

if (isset($_GET['numero_orden'])) {
    $numero_orden_buscar = $_GET['numero_orden'];

    // Leer el contenido del archivo JSON
    $data = json_decode(file_get_contents($dataFile), true);

    if ($data !== null && isset($data[$numero_orden_buscar])) {
        header('Content-Type: application/json');
        echo json_encode($data[$numero_orden_buscar]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(null); // No se encontró la orden
    }
} else {
    // Si no se proporciona el número de orden
    header('Content-Type: application/json');
    echo json_encode(null);
}
?>
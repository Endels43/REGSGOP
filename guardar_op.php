<?php
$dataFile = 'ordenes_produccion.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_orden = $_POST['numero_orden'] ?? '';
    $fecha_actual = $_POST['fecha_actual'] ?? '';
    $inicia_pre_prensa = $_POST['inicia_pre_prensa'] ?? null;
    $finaliza_pre_prensa = $_POST['finaliza_pre_prensa'] ?? null;
    $fecha_aprobada = $_POST['fecha_aprobada'] ?? null;
    $cantidad_motivos = $_POST['cantidad_motivos'] ?? null;
    $estatus_op = $_POST['estatus_op'] ?? '';
    $area_trabajo = $_POST['area_trabajo'] ?? null;
    $comentarios = $_POST['comentarios'] ?? null;

    if (!empty($numero_orden) && !empty($fecha_actual)) {
        $nueva_orden = [
            'numero_orden' => $numero_orden,
            'fecha_actual' => $fecha_actual,
            'inicia_pre_prensa' => $inicia_pre_prensa,
            'finaliza_pre_prensa' => $finaliza_pre_prensa,
            'fecha_aprobada' => $fecha_aprobada,
            'cantidad_motivos' => $cantidad_motivos,
            'estatus_op' => $estatus_op,
            'area_trabajo' => $area_trabajo,
            'comentarios' => $comentarios,
        ];

        // Leer el contenido actual del archivo JSON
        $data = json_decode(file_get_contents($dataFile), true);

        // Si el archivo no existe o está vacío, inicializar un array
        if ($data === null) {
            $data = [];
        }

        // Agregar la nueva orden al array usando el número de orden como clave
        $data[$numero_orden] = $nueva_orden;

        // Guardar el array actualizado en el archivo JSON
        if (file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT))) {
            echo "Información guardada exitosamente para la orden: " . htmlspecialchars($numero_orden);
        } else {
            echo "Error al guardar la información.";
        }
    } else {
        echo "El número de orden y la fecha actual son obligatorios.";
    }
} else {
    // Si alguien intenta acceder a este archivo por GET
    echo "Este script solo acepta solicitudes POST.";
}
?>
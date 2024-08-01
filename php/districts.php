<?php
require_once 'db_config.php';

header('Content-Type: application/json');

if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];
    $query = "SELECT id, name FROM Districts WHERE Department_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $department_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $districts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($districts);
    } else {
        echo json_encode(['error' => 'Error al obtener los distritos']);
    }
} else {
    echo json_encode(['error' => 'Departamento no proporcionado']);
}

mysqli_close($conn);
?>
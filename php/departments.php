<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$query = "SELECT id, name FROM Departments";
$result = mysqli_query($conn, $query);

if ($result) {
    $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($departments);
} else {
    echo json_encode(['error' => 'Error al obtener los departamentos']);
}

mysqli_close($conn);
?>
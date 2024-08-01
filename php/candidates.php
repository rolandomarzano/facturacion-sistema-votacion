<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$query = "SELECT id, name FROM Candidates";
$result = mysqli_query($conn, $query);

if ($result) {
    $candidates = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($candidates);
} else {
    echo json_encode(['error' => 'Error al obtener los candidatos']);
}

mysqli_close($conn);
?>
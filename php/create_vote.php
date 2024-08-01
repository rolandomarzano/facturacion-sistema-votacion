<?php
require_once 'db_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $alias = $_POST['alias'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $how_know_us = implode(',', $_POST['how_know_us']);
    $department_id = $_POST['department'];
    $district_id = $_POST['district'];
    $candidate_id = $_POST['candidate'];

    $errors = [];

    if (empty($name)) {
        $errors[] = "El nombre es requerido";
    }

    if (empty($last_name)) {
        $errors[] = "El apellido es requerido";
    }

    if (strlen($alias) <= 5 || !preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $alias)) {
        $errors[] = "El alias debe tener más de 5 caracteres y contener letras y números";
    }

    if (!preg_match('/^\d{8}$/', $dni)) {
        $errors[] = "El DNI debe tener 8 dígitos";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Correo electrónico no válido";
    }

    if (empty($department_id) || empty($district_id)) {
        $errors[] = "Debe seleccionar un Departamento y un Distrito";
    }

    if (empty($candidate_id)) {
        $errors[] = "Debe seleccionar un candidato";
    }

    if (count($_POST['how_know_us']) < 2) {
        $errors[] = "Debe seleccionar al menos dos opciones en 'Cómo se enteró de Nosotros'";
    }

    $query = "SELECT id FROM Voters WHERE dni = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $dni);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $errors[] = "Ya existe un voto registrado con este número de DNI";
    }

    if (empty($errors)) {
        $query = "INSERT INTO Voters (name, last_name, alias, dni, email, how_know_us, department_id, district_id, candidate_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssiii", $name, $last_name, $alias, $dni, $email, $how_know_us, $department_id, $district_id, $candidate_id);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Voto registrado con éxito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el voto']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}

mysqli_close($conn);
?>
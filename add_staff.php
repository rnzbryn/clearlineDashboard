<?php
header('Content-Type: application/json');
include 'db_connect.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$department = trim($_POST['department'] ?? '');
$role = trim($_POST['role'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '' || $department === '' || $role === '' || $password === '') {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "All staff fields are required."]);
    $conn->close();
    exit;
}

if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[^A-Za-z0-9]/', $password)
) {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Password must be 8+ characters with a capital letter, number, and special character."]);
    $conn->close();
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO staff (staff_name, email, department, role, status, password) VALUES (?, ?, ?, ?, 'Active', ?)");
$stmt->bind_param("sssss", $name, $email, $department, $role, $passwordHash);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "id" => $conn->insert_id, "status" => "Active"]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
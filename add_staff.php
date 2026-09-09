<?php
header('Content-Type: application/json');
include 'db_connect.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$department = trim($_POST['department'] ?? '');
$role = trim($_POST['role'] ?? '');

if ($name === '' || $email === '' || $department === '' || $role === '') {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "All staff fields are required."]);
    $conn->close();
    exit;
}

$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$department = $conn->real_escape_string($department);
$role = $conn->real_escape_string($role);

$sql = "INSERT INTO staff (staff_name, email, department, role, status) VALUES ('$name', '$email', '$department', '$role', 'Active')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "id" => $conn->insert_id, "status" => "Active"]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
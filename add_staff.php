<?php
header('Content-Type: application/json');
include 'db_connect.php';

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$department = $conn->real_escape_string($_POST['department']);
$role = $conn->real_escape_string($_POST['role']);

$sql = "INSERT INTO staff (staff_name, email, department, role) VALUES ('$name', '$email', '$department', '$role')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "id" => $conn->insert_id]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
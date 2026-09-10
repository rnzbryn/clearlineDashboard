<?php
header("Content-Type: application/json");

include "db_connect.php";

$email = trim($_POST["email"] ?? "");

if ($email === "") {
  echo json_encode([
    "success" => false,
    "error" => "Staff email is required."
  ]);
  exit;
}

/* Delete the matching Staff record from MySQL */
$stmt = $conn->prepare("DELETE FROM staff WHERE email = ?");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
  echo json_encode([
    "success" => true,
    "deleted_rows" => $stmt->affected_rows
  ]);
} else {
  echo json_encode([
    "success" => false,
    "error" => $stmt->error
  ]);
}

$stmt->close();
$conn->close();
?>
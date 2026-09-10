<?php
header("Content-Type: application/json");

include "db_connect.php";

$email = trim($_POST["email"] ?? "");
$status = trim($_POST["status"] ?? "");
$allowedStatuses = ["Active", "Archived"];

if ($email === "" || !in_array($status, $allowedStatuses, true)) {
  http_response_code(400);
  echo json_encode([
    "success" => false,
    "error" => "A valid staff email and status are required."
  ]);
  $conn->close();
  exit;
}

$stmt = $conn->prepare("UPDATE staff SET status = ? WHERE email = ?");
$stmt->bind_param("ss", $status, $email);

if (!$stmt->execute()) {
  http_response_code(500);
  echo json_encode(["success" => false, "error" => $stmt->error]);
} else {
  echo json_encode([
    "success" => true,
    "updated_rows" => $stmt->affected_rows,
    "status" => $status
  ]);
}

$stmt->close();
$conn->close();
?>

<?php
header("Content-Type: application/json");

include "db_connect.php";

$sql = "
  SELECT staff_id AS id, staff_name, email, department, role, COALESCE(NULLIF(status, ''), 'Active') AS status
  FROM staff
  ORDER BY id ASC
";

$result = $conn->query($sql);

if (!$result) {
  http_response_code(500);
  echo json_encode(["success" => false, "error" => $conn->error]);
  $conn->close();
  exit;
}

$staff = [];

while ($row = $result->fetch_assoc()) {
  $staff[] = $row;
}

echo json_encode($staff);

$conn->close();
?>
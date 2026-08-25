<?php
header("Content-Type: application/json");

include "db_connect.php";

$sql = "
  SELECT id, staff_name, email, department, role
  FROM staff
  ORDER BY id ASC
";

$result = $conn->query($sql);

$staff = [];

while ($row = $result->fetch_assoc()) {
  $staff[] = $row;
}

echo json_encode($staff);

$conn->close();
?>
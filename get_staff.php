<?php
header('Content-Type: application/json');
include 'db_connect.php';

$result = $conn->query("SELECT * FROM staff ORDER BY staff_id ASC");
$staff = [];

while ($row = $result->fetch_assoc()) {
    $staff[] = $row;
}

echo json_encode($staff);
$conn->close();
?>
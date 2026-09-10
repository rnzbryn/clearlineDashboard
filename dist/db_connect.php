<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

$host = getenv("CLEARLINE_DB_HOST") ?: "localhost";
$user = getenv("CLEARLINE_DB_USER") ?: "root";
$password = getenv("CLEARLINE_DB_PASSWORD") ?: "";
$dbname = getenv("CLEARLINE_DB_NAME") ?: "clearlinedashboard";

$port = (int) (getenv("CLEARLINE_DB_PORT") ?: 3306);

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Database connection failed."]);
    exit;
}

$conn->set_charset("utf8mb4");
?>
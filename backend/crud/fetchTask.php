<?php
header("Content-Type: application/json");

require_once "../config/db.php"; 

$response = [
    "success" => false,
    "message" => "",
    "data" => []
];

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    $response["message"] = "Invalid request method";
    echo json_encode($response);
    exit;
}

try {
    $sql = "SELECT id, name, descript, start, end, dur,status, progress 
            FROM task
            ORDER BY id ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($tasks) {
        $response["success"] = true;
        $response["message"] = "Tasks fetched successfully";
        $response["data"] = $tasks;
    } else {
        $response["message"] = "No tasks found";
    }

} catch (PDOException $e) {
    $response["message"] = "Database error: " . $e->getMessage();
}

echo json_encode($response);
exit;
?>
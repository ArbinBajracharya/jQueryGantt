<?php
header("Content-Type: application/json");

require_once "../config/db.php";

$response = [
    "success" => false,
    "message" => ""
];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $response["message"] = "Invalid request method";
    echo json_encode($response);
    exit;
}

// Get POST data
$id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
$start = isset($_POST["start"]) ? trim($_POST["start"]) : "";
$end = isset($_POST["end"]) ? trim($_POST["end"]) : "";
$duration = isset($_POST["duration"]) ? trim($_POST["duration"]) : "";

// Validation
if (empty($id)) {
    $response["message"] = "Task ID is required";
    echo json_encode($response);
    exit;
}

if (empty($start)) {
    $response["message"] = "Start Date not found";
    echo json_encode($response);
    exit;
}

if (empty($end)) {
    $response["message"] = "End Date not found";
    echo json_encode($response);
    exit;
}

try {
    $sql = "UPDATE task 
            SET start = :start,
                end = :end,
                dur = :duration
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":start", $start);
    $stmt->bindParam(":end", $end);
    $stmt->bindParam(":duration", $duration);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Task updated successfully";
    } else {
        $response["message"] = "Failed to update task";
    }

} catch (PDOException $e) {
    $response["message"] = "Database error: " . $e->getMessage();
}

echo json_encode($response);
exit;
?>
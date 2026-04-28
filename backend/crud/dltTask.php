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

// Validation
if (empty($id)) {
    $response["message"] = "Task ID is required";
    echo json_encode($response);
    exit;
}

try {
    $sql = "DELETE FROM task WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $response["success"] = true;
            $response["message"] = "Task deleted successfully";
        } else {
            $response["message"] = "Task not found";
        }
    } else {
        $response["message"] = "Failed to delete task";
    }

} catch (PDOException $e) {
    $response["message"] = "Database error: " . $e->getMessage();
}

echo json_encode($response);
exit;
?>
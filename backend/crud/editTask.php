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
$title = isset($_POST["title"]) ? trim($_POST["title"]) : "";
$start = isset($_POST["start"]) ? trim($_POST["start"]) : "";
$end = isset($_POST["end"]) ? trim($_POST["end"]) : "";
$descript = isset($_POST["descript"]) ? trim($_POST["descript"]) : "";
$progress = isset($_POST["progress"]) ? trim($_POST["progress"]) : "";
$duration = isset($_POST["duration"]) ? trim($_POST["duration"]) : "";

// Convert m/d/yyyy → yyyy-mm-dd
function convertDate($date) {
    if (empty($date)) return null;

    $d = DateTime::createFromFormat("m/d/Y", $date);
    if (!$d) return null;

    return $d->format("Y-m-d");
}

$start = convertDate($start);
$end = convertDate($end);

// Validation
if (empty($id)) {
    $response["message"] = "Task ID is required";
    echo json_encode($response);
    exit;
}

if (empty($title)) {
    $response["message"] = "Task title is required";
    echo json_encode($response);
    exit;
}

try {
    $sql = "UPDATE task 
            SET name = :title,
                descript = :descript,
                start = :start,
                end = :end,
                progress = :progress,
                dur = :duration
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":descript", $descript);
    $stmt->bindParam(":start", $start);
    $stmt->bindParam(":end", $end);
    $stmt->bindParam(":progress", $progress);
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
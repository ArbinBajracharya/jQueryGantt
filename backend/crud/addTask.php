<?php
header("Content-Type: application/json");

require_once "../config/db.php"; // your DB connection file

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
$title = isset($_POST["title"]) ? trim($_POST["title"]) : "";
$start = isset($_POST["start"]) ? trim($_POST["start"]) : "";
$end = isset($_POST["end"]) ? trim($_POST["end"]) : "";
$descript = isset($_POST["descript"]) ? trim($_POST["descript"]) : "";
$dur = isset($_POST["duration"]) ? trim($_POST["duration"]) : "";
$progress = isset($_POST["progress"]) ? trim($_POST["progress"]) : "";

function convertDate($date) {
    if (empty($date)) return null;

    $d = DateTime::createFromFormat("m/d/Y", $date);
    if (!$d) return null;

    return $d->format("Y-m-d");
}

$start = convertDate($start);
$end = convertDate($end);

// Validation
if (empty($title)) {
    $response["message"] = "Task title is required";
    echo json_encode($response);
    exit;
}

try {
    $sql = "INSERT INTO task (name, descript, start, end,dur,progress) 
            VALUES (:title, :descript, :start, :end, :dur, :progress)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":descript", $descript);
    $stmt->bindParam(":start", $start);
    $stmt->bindParam(":end", $end);
    $stmt->bindParam(":dur", $dur);
    $stmt->bindParam(":progress", $progress);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Task added successfully";
        $response["task_id"] = $conn->lastInsertId();
    } else {
        $response["message"] = "Failed to add task";
    }

} catch (PDOException $e) {
    $response["message"] = "Database error: " . $e->getMessage();
}

echo json_encode($response);
exit;
?>
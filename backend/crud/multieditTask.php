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
$status = isset($_POST["status"]) ? trim($_POST["status"]) : "";
$duration = isset($_POST["duration"]) ? trim($_POST["duration"]) : "";

// Convert m/d/yyyy → yyyy-mm-dd
function convertDate($date) {
    if (empty($date)) return null;

    $d = DateTime::createFromFormat("m/d/Y", $date);
    if (!$d) return null;

    return $d->format("Y-m-d");
}

if (!empty($start)) {
    $start = convertDate($start);
}

if (!empty($end)) {
    $end = convertDate($end);
}

// Validation
if (empty($id)) {
    $response["message"] = "Task ID is required";
    echo json_encode($response);
    exit;
}

try {
    $fields = [];
    $params = [":id" => $id];

    if (!empty($title)) {
        $fields[] = "name = :title";
        $params[":title"] = $title;
    }

    if (!empty($descript)) {
        $fields[] = "descript = :descript";
        $params[":descript"] = $descript;
    }

    if (!empty($start)) {
        $fields[] = "start = :start";
        $params[":start"] = $start;
    }

    if (!empty($end)) {
        $fields[] = "end = :end";
        $params[":end"] = $end;
    }

    if ($progress !== "") {
        $fields[] = "progress = :progress";
        $params[":progress"] = $progress;
    }

    if (!empty($status)) {
        $fields[] = "status = :status";
        $params[":status"] = $status;
    }

    if (!empty($duration)) {
        $fields[] = "dur = :duration";
        $params[":duration"] = $duration;
    }

    if (empty($fields)) {
        $response["message"] = "No fields to update";
        echo json_encode($response);
        exit;
    }

    $sql = "UPDATE task SET " . implode(", ", $fields) . " WHERE id = :id";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute($params)) {
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
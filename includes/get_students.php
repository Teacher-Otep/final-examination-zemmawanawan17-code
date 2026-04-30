<?php
require_once 'db.php';

header('Content-Type: application/json');

$id = intval($_GET['id'] ?? 0);

if ($id === 0) {
    echo json_encode(['error' => 'Invalid ID']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    echo json_encode(['error' => 'Student not found']);
    exit;
}

echo json_encode($row);
?>
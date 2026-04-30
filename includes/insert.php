<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = trim($_POST['surname'] ?? '');
    $name    = trim($_POST['name']    ?? '');
    $midname = trim($_POST['midname'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $mobile  = trim($_POST['mobile']  ?? '');

    $stmt = $conn->prepare("INSERT INTO students (surname, name, midname, address, mobile) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $surname, $name, $midname, $address, $mobile);
    $stmt->execute();
    $stmt->close();

    header('Location: ../public/index.php?status=inserted&section=create');
    exit;
}
header('Location: ../public/index.php');
exit;
?>
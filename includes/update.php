<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = intval($_POST['id']      ?? 0);
    $surname = trim($_POST['surname']   ?? '');
    $name    = trim($_POST['name']      ?? '');
    $midname = trim($_POST['midname']   ?? '');
    $address = trim($_POST['address']   ?? '');
    $mobile  = trim($_POST['mobile']    ?? '');

    $stmt = $conn->prepare("UPDATE students SET surname=?, name=?, midname=?, address=?, mobile=? WHERE id=?");
    $stmt->bind_param('sssssi', $surname, $name, $midname, $address, $mobile, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: ../public/index.php?status=updated&section=update');
    exit;
}
header('Location: ../public/index.php');
exit;
?>
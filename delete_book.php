<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM livres WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: dashboard.php');
    exit;
} else {
    echo "Erreur: " . $conn->error;
}

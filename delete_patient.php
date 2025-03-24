<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'mh_care');

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Delete patient record
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM patients WHERE patient_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    header('Location: view_patients.php');
    exit();
}
?>

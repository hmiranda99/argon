<?php
header('Location: ./categories.page.php');
include_once '../../../database/connection.php';

$id = $_GET['idCategoria'];

$connection = Connection::connection();

try {
    $stmt = $connection->prepare("DELETE FROM tbCategoria WHERE idCategoria='$id'");
    $stmt->execute();
} catch (Exception $e) {
    echo $e->getMessage();
}
<?php
header('Location: ./products.page.php');
include_once '../../../database/connection.php';

$id = $_GET['idProduto'];

$connection = Connection::connection();

try {
    $stmt = $connection->prepare("DELETE FROM tbProduto WHERE idProduto='$id'");
    $stmt->execute();
} catch (Exception $e) {
    echo $e->getMessage();
}
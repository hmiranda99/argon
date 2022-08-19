<?php
header('Location: ./categories.page.php');
require_once('../../../database/Connection.php');

$connection = Connection::connection();


if (isset($_POST['atualizar'])) {

    $id = $_GET['atualizarId'];
    $nome = $_POST['attCategoria'];

    $stmt = $connection->prepare("UPDATE tbcategoria
                                SET nomeCategoria = ?
                                    WHERE idCategoria = $id");
    $stmt->bindValue(1, $nome);

    $stmt->execute();
}
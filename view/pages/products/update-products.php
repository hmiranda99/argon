<?php
header('Location: ./products.page.php');
require_once('../../../database/Connection.php');

$connection = Connection::connection();


if (isset($_POST['atualizar'])) {

    $id = $_GET['atualizarId'];
    $nome = $_POST['attNome'];
    $valor = $_POST['attValor'];
    $categoria = $_POST['attCategoria'];

    $stmt = $connection->prepare("UPDATE tbproduto
                                SET produto = ?, valor = ?, idCategoria = ?
                                    WHERE idProduto = $id");
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $valor);
    $stmt->bindValue(3, $categoria);

    $stmt->execute();
}

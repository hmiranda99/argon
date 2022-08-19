<?php
    header('Location: ./products.page.php');
    include '../../../database/connection.php';
    require_once('./Product.class.php');

    $product = new Product();

    $product->setNomeProduto($_POST['nameProduct']);
    $product->setIdCategoria($_POST['valueProduct']);
    $product->setValorProduto($_POST['idCategory']);
    $product->register($product);
?>
<?php

require_once('../../../database/Connection.php');
require_once("./Product.class.php");

try {
    $product = new Product();
    $listProducts = $product->list();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en" style='height: 100%' ;>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container" style="margin-top: 5%;">
        <table class="table table-striped mb-5">
            <thead class="text-light" style="background-color: #3182CE">
                <tr>
                    <th scope="col" class="h5">Nome</th>
                    <th scope="col" class="h5">Valor</th>
                    <th scope="col" class="h5">Categoria</th>
                    <th scope="col" class="h5">Alterar</th>
                    <th scope="col" class="h5">Excluir</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($row = $listProducts->fetch(PDO::FETCH_BOTH)) { ?>
                    <tr>
                        <th><?php echo $row[1]; ?></th>
                        <th><?php echo $row[2]; ?></th>
                        <th><?php echo $row[3]; ?></th>
                        <th>
                            <a class="btn btn-primary" style="background-color: #1A237E;" href="./update-products.page.php?atualizarProduto=<?php echo $row[0]; ?>" role="button">
                                <i class="fas fa-pen"></i>
                            </a>
                        </th>

                        <th>
                            <a class="btn btn-primary ml-5" style="background-color: #c61118;" href="./delete-products.php?idProduto=<?php echo $row[0]; ?>" role="button">
                                <i class="fas fa-trash"></i>
                            </a>
                        </th>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</body>

</html>
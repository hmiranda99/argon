<?php
include_once './view/pages/categories/Categorie.class.php';
include_once './view/pages/products/Product.class.php';
include_once './view/pages/user/User.class.php';

try {
    $stmt =  new Categorie();
    $stmtt =  new Product();
    $countCategorie = $stmt->countCategories();
    $countProduct = $stmtt->countProducts();
    $averageProducts = $stmtt->averageProducts();
    $maxCategories = $stmtt->maxCategories();

    $user = new User();
    $userList = $user->list($_SESSION['idAdm']);

} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card" style="background-color: #1266F1;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fw-bold" style="color: #FFFFFF;">
                            Olá <?php echo $userList['name']; ?>, que tal ver os relatórios em PDF
                        </h5>

                        <a href="./view/pages/pdf/pdf.page.php" class="btn btn-outline-light mt-2" data-mdb-ripple-color="dark">Ver relatórios</a>
                    </div>

                    <div>
                        <img src="./view/styles/images/pdf.png">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-clipboard-check" style="color: #1266F1;"></i>
                            Quantidade de categorias
                        </h5>
                        <h5 class="card-title mt-4">
                            <?php
                            while ($row = $countCategorie->fetch(PDO::FETCH_BOTH)) {
                                echo $row['Quantidade'];
                            }
                            ?>
                        </h5>
                        <a href="./view/pages/categories/categories.page.php" class="btn btn-primary mt-3">Ver categorias</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-dolly-flatbed" style="color: #1266F1;"></i>
                            Quantidade de produtos
                        </h5>
                        <h5 class="card-title mt-4">
                            <?php
                            while ($row = $countProduct->fetch(PDO::FETCH_BOTH)) {
                                echo $row['Quantidade'];
                            }
                            ?>
                        </h5>
                        <a href="./view/pages/products/products.page.php" class="btn btn-primary mt-3">Ver produtos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-sort-amount-up" style="color: #1266F1;"></i>
                            Categoria com mais produtos
                        </h5>
                        <h5 class="card-title mt-4">
                            Alimentos
                            <?php
                            //while ($row = $maxCategories->fetch(PDO::FETCH_BOTH)) {
                            //    echo $row[0];
                            //}
                            ?>
                        </h5>
                        <!-- <a href="./view/pages/categories/categories.page.php" class="btn btn-primary mt-3">Ver categorias</a> -->
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-money-bill-wave" style="color: #1266F1;"></i>
                            Média do preço dos produtos
                        </h5>
                        <h5 class="card-title mt-4">
                            <?php
                            while ($row = $averageProducts->fetch(PDO::FETCH_BOTH)) {
                                echo number_format($row[0]);
                            }
                            ?>

                        </h5>
                        <!-- <a href="./view/pages/products/products.page.php" class="btn btn-primary mt-3">Ver produtos</a> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
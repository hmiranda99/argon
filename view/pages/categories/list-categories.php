<?php
require_once('../../../database/Connection.php');
require_once("./Categorie.class.php");

try {
    $categorie = new Categorie();
    $listCategorie = $categorie->list();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>


<div class="container" style="margin-top: 5%;">
    <table class="table table-striped m-b-5">
        <thead class="text-light" style="background-color: #3182CE">
            <tr>
                <th scope="col" class="h5">Categorias cadastradas</th>
                <th scope="col" class="h5">Alterar</th>
                <th scope="col" class="h5">Excluir</th>
            </tr>
        </thead>
        <tbody>

            <?php while ($row = $listCategorie->fetch(PDO::FETCH_BOTH)) { ?>
                <tr>
                    <th><?php echo $row[1]; ?></th>

                    <th>
                        <a class="btn btn-primary" style="background-color: #1A237E;" href="./update-categories.page.php?atualizarCategoria=<?php echo $row[0]; ?>" role="button">
                            <i class="fas fa-pen"></i>
                        </a>
                    </th>
                    <th>
                        <a class="btn btn-primary ml-5" style="background-color: #c61118;" href="./delete-categories.php?idCategoria=<?php echo $row[0]; ?>" role="button">
                            <i class="fas fa-trash"></i>
                        </a>
                    </th>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>
<?php
include_once '../../../database/connection.php';

$connection = Connection::connection();
// Se EXISTIR a ID vinda pelo método GET, ele fará o bloco de comando proposto.

if (isset($_GET['atualizarCategoria'])) {

    $id = $_GET['atualizarCategoria'];

    $stmt = $connection->prepare("SELECT * FROM tbCategoria
                                    WHERE idCategoria = $id
                                    ");
    $stmt->execute();
    $rowCat = $stmt->fetch(PDO::FETCH_BOTH);
}

?>

<div class="mt-5 mb-5">
    <div class="d-flex justify-content-center" style="height: 100%;">
        <div class="card text-center" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Atualizar Categorias</h5>

                <form action="../../pages/categories/update-categories.php?atualizarId=<?php echo $rowCat[0] ?>" method="post">
                    <div class="form-outline mt-4">
                        <input type="text" id="formControlLg" name="attCategoria" class="form-control form-control-lg" value="<?php echo $rowCat[1] ?>" />
                        <label class="form-label" for="formControlLg">Nome da categoria</label>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <input type="submit" class="btn" value="Atualizar" name="atualizar" style="background-color: #1A237E; color: #ffffff;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
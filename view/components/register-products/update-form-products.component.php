<?php
include_once '../../../database/connection.php';

$connection = Connection::connection();
// Se EXISTIR a ID vinda pelo método GET, ele fará o bloco de comando proposto.

if (isset($_GET['atualizarProduto'])) {

    $id = $_GET['atualizarProduto'];

    $stmt = $connection->prepare("SELECT tbproduto.produto, tbproduto.valor, tbcategoria.nomeCategoria, tbcategoria.idCategoria, tbproduto.idProduto FROM tbproduto
                            INNER JOIN tbcategoria ON tbcategoria.idCategoria = tbproduto.idCategoria
                                WHERE tbproduto.idProduto = $id");
    $stmt->execute();
    $rowProd = $stmt->fetch(PDO::FETCH_BOTH);
}

// Selecionando todas as linhas da tbCategoria e colocando-as em uma lista para usar no FOREACH
$stmt = $connection->prepare("SELECT * FROM tbcategoria");
$stmt->execute();
$result = $stmt->fetchAll();
$list = $result;
?>

<div class="mt-5 mb-5">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="card text-center" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Atualizar produto</h5>

                <form action="../../pages/products/update-products.php?atualizarId=<?php echo $rowProd[4]?>" method="post">
                    <div class="form-outline mt-4">
                        <input type="text" name="attNome" id="formControlLg" class="form-control form-control-lg" value="<?php echo $rowProd[0] ?>" />
                        <label class="form-label" for="formControlLg">Nome do produto</label>
                    </div>

                    <div class="form-outline mt-4">
                        <input type="number" name="attValor" id="formControlLg" class="form-control form-control-lg" value="<?php echo $rowProd[1] ?>" />
                        <label class="form-label" for="typeNumber">Valor do produto</label>
                    </div>

                    <select class="form-select mt-4 form-control-lg" aria-label="Default select example" name="attCategoria" id="attCategoria">
                        <optgroup label="Categoria Atual">
                            <option value="<?php echo $rowProd[3] ?>"><?php echo $rowProd[2] ?></option>
                        </optgroup>

                        <optgroup label="Categoria Disponíveis">
                            <?php foreach ($list as $row) { ?>
                                <option value="<?php echo $row[0] ?>"> <?php echo $row[1] ?> </option>
                            <?php } ?>
                        </optgroup>
                    </select>

                    <div class="d-grid gap-2 mt-5">
                        <input type="submit" value="Atualizar" class="btn" name="atualizar" style="background-color: #1A237E; color: #ffffff;">
                        <button type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
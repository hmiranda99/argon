<?php

require_once('../../pages/products/Product.class.php');

try {
    $product = new Product();
    $list = $product->selectList();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php

if (isset($_POST['pesquisando'])) {
    $cep = $_POST['cep'];
}

if (isset($cep)) {
    $url = "https://viacep.com.br/ws/$cep/json/";
    $json = file_get_contents($url);
    $dados = json_decode($json, true);
}


if (isset($_POST['enviando'])) {
    $logra = $_POST['log'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $uf = $_POST['estado'];
    $numero = $_POST['numero'];
    $comp = $_POST['comp'];
}

?>

<div class="mt-5 mb-5">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="card text-center" style="width: 46rem;">
            <div class="card-body">
                <h5 class="card-title mb-5">Cadastro de Fornecedores</h5>

                <form class="row g-3 mb-3" method="post">
                    <div class="col-md-5">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="validationDefault02" name="cep" value="<?php if (isset($dados)) echo $dados['cep'] ?>" required />
                            <label for="validationDefault02" class="form-label">CEP</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <input type="submit" class="btn btn-primary" style="background-color: #333333;" name="pesquisando" value="Pesquisar" />
                    </div>
                </form>


                <form class="row g-3" method="post">
                    <div class="col-md-8">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="validationDefault03" name="log" value="<?php if (isset($dados)) echo $dados['logradouro'] ?>" required />
                            <label for="validationDefault03" class="form-label">Logradouro</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="text" class="form-control" name="numero" id="validationDefault05" required />
                            <label for="validationDefault05" class="form-label">Número</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-outline">
                            <input type="text" class="form-control" name="comp" id="validationDefault03" required />
                            <label for="validationDefault03" class="form-label">Complemento</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="validationDefault05" name="bairro" value="<?php if (isset($dados)) echo $dados['bairro'] ?>" required />
                            <label for="validationDefault05" class="form-label">Bairro</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="validationDefault03" name="cidade" value="<?php if (isset($dados)) echo $dados['localidade'] ?>" required />
                            <label for="validationDefault03" class="form-label">Estado</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="validationDefault05" name="estado" value="<?php if (isset($dados)) echo $dados['uf'] ?>" required />
                            <label for="validationDefault05" class="form-label">UF</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <input type="submit" class="btn btn-primary" value="Cadastrar" name="enviando">
                        <button type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-5" style="height: 100%;">
        <div class="card" style="width: 46rem;">
            <div class="card-body">
                <h5 class="card-title mb-5 text-center">Resultado do cadastro</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <p>
                                Logradouro:
                                <?php if (isset($logra)) echo $logra ?>
                            </p>
                        </div>

                        <div>
                            <p>
                                Número:
                                <?php if (isset($logra)) echo $numero ?>
                            </p>
                        </div>

                        <div>
                            <p>
                                Complemento
                                <?php if (isset($logra)) echo $comp ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <p>
                                Bairro:
                                <?php if (isset($logra)) echo $bairro ?>
                            </p>
                        </div>

                        <div>
                            <p>
                                Cidade:
                                <?php if (isset($logra)) echo $cidade ?>
                            </p>
                        </div>

                        <div>
                            <p>
                                Estado:
                                <?php if (isset($logra)) echo $uf ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php

require_once('../../pages/products/Product.class.php');

try {
    $product = new Product();
    $list = $product->selectList();
} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<div class="mt-5 mb-5">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="card text-center" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Cadastro de Produtos</h5>

                <form action="../../pages/products/insert-products.php" method="post" onsubmit="return validarTudo()">
                    <div class="form-outline mt-4">
                        <input type="text" id="nameProduct" name="nameProduct" class="form-control form-control-lg" required/>
                        <label class="form-label" for="formControlLg">Nome do produto</label>
                    </div>

                    <div class="form-outline mt-4">
                        <input type="text" id="valueProduct" name="valueProduct" class="form-control form-control-lg" required/>
                        <label class="form-label" for="typeNumber">Valor do produto</label>
                    </div>

                    <select class="form-select mt-4 form-control-lg" aria-label="Default select example" name="idCategory" required>
                        <option selected>Selecione a categoria do produto</option>
                        <?php foreach ($list as $value) { ?>
                            <option value="<?php echo ($value['idCategoria']) ?>"> <?php echo ($value['nomeCategoria']) ?> </option>
                        <?php } ?>
                    </select>

                    <div class="d-grid gap-2 mt-5">
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                        <button type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function validarNome(){
        var nome = document.getElementById('nameProduct').value

        if(nome.length > 3){
            return true
            
        } else{
            alert('O nome do produto deve ter mais de 3 CARACTERES.')
            return false

        }

    }

    function validarValor(){
        var valor = document.getElementById('valueProduct').value

        if(Number(valor) <= 0){
            alert('O valor do produto deve ser maior ou igual a R$ 1,00')
            return false

        } else{
            return true

        }

    }

    function validarTudo(){

        if(validarNome() && validarValor()){
            alert("Dados inseridos com sucesso!")
            return true

        } else{
            return false

        }



    }


</script>
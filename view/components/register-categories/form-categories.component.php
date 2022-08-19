<div class="mt-5 mb-5">
    <div class="d-flex justify-content-center" style="height: 100%;">
        <div class="card text-center" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Cadastro de Categorias</h5>

                <form action="../../pages/categories/insert-categories.php" method="post" onsubmit="return validarCategoria()">
                    <div class="form-outline mt-4">
                        <input type="text" id="input-categories"" name="input-categories" class="form-control form-control-lg" required/>
                        <label class="form-label" for="formControlLg">Nome da categoria</label>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <input type="submit" class="btn btn-primary" value="Cadastrar" onclick="validarCategoria()">
                        <button type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validarCategoria(){
        var categoria = document.getElementById('input-categories').value

        if(categoria.length < 3){
            alert("A quantidade de caracteres do NOME deve ser maior que 5!");
            return false

        } else{
            return true
        }
    }




</script>
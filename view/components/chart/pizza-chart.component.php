<div class="container mt-5">
    <div class="row d-flex">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body ">
                    <h5 class="card-title fw-bold mt-3 mb-5 text-center">
                        <i class="fas fa-clipboard" style="color: #1266F1;"></i>
                        Quantidade de produtos por categoria
                    </h5>
                    <div style="position: relative; height:525px; width:525px">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold mt-3 mb-5 text-center">
                        <i class="fas fa-clipboard-list" style="color: #1266F1;"></i>
                        Valor total e média dos produtos por categorias
                    </h5>
                    <div style="position: relative; width:600px">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="card"  style="background-color: #1266F1;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div >
                            <h5 class="card-title fw-bold" style="color: #FFFFFF;">
                                Precisou dos dados em JSON?
                            </h5>
                            <a href="./view/pages/products/products.json.php" class="btn btn-outline-light mt-2" data-mdb-ripple-color="dark">Área do desenvolvedor</a>
                        </div>

                        <div >
                            <img src="./view/styles/images/dev.png">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php

require_once('/xampp/htdocs/argon/database/Connection.php');

$connection = Connection::connection();

try {
    $stmt = $connection->prepare(" SELECT COUNT(idProduto), c.nomeCategoria FROM tbproduto p
	                                INNER JOIN tbCategoria c ON c.idCategoria = p.idCategoria
    	                                GROUP BY p.idCategoria ");

    $stmt->execute();

    $list = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    $stmt = $connection->prepare(" SELECT AVG(p.valor), c.nomeCategoria FROM tbProduto p
                                    INNER JOIN tbCategoria c ON c.idCategoria = p.idCategoria
                                        GROUP BY p.idCategoria ");
    $stmt->execute();

    $list_avg = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    $stmt = $connection->prepare(" SELECT SUM(p.valor) FROM tbProduto p
                                        GROUP BY idCategoria ");
    $stmt->execute();

    $list_sum = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>


<script>
    const data_1 = {
        labels: [
            <?php foreach ($list as $row) { ?> '<?php echo $row[1]; ?>',
            <?php } ?>
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [
                <?php foreach ($list as $row) { ?>
                    <?php echo $row[0]; ?>,
                <?php } ?>
            ],
            backgroundColor: [
                'rgb(76, 201, 240)',
                'rgb(72, 149, 239)',
                'rgb(67, 97, 238)',
                'rgb(63, 55, 201)',
                'rgb(58, 12, 163)',
                'rgb(72, 12, 168)',
                'rgb(86, 11, 173)',
                'rgb(114, 9, 183)',
                'rgb(181, 23, 158)',
                'rgb(247, 37, 133)',
            ],
            hoverOffset: 4
        }]
    };

    const config_1 = {
        type: 'polarArea',
        data: data_1,
    };

    //------------------------------------------------------------------------------
    const data = {
        labels: [
            <?php foreach ($list_avg as $row) { ?> '<?php echo $row[1]; ?>',
            <?php } ?>
        ],
        datasets: [{
            type: 'bar',
            label: 'Soma dos produtos',
            data: [
                <?php foreach ($list_sum as $row) { ?>
                    <?php echo $row[0]; ?>,
                <?php } ?>
            ],
            borderColor: 'rgba(247, 37, 133)',
            backgroundColor: 'rgba(247, 37, 133, 0.2)'
        }, {
            type: 'line',
            label: 'Média dos produtos',
            data: [
                <?php foreach ($list_avg as $row) { ?>
                    <?php echo $row[0]; ?>,
                <?php } ?>
            ],
            fill: false,
            borderColor: 'rgb(54, 162, 235)'
        }]
    };

    const config = {
        type: 'scatter',
        data: data,
        options: {
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
            scales: {
                y: { // defining min and max so hiding the dataset does not change scale range
                    min: 0,
                    max: 100
                }
            }
        }
    };
</script>

<script>
    const chart1 = new Chart(
        document.getElementById('chart1'),
        config_1
    );

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>/
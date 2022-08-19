<?php
    require_once('/xampp/htdocs/argon/database/Connection.php');

    $connection = Connection::connection();

    $stmt = $connection->prepare("SELECT * FROM tbProduto");
    $stmt->execute();

    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

    echo json_encode($data);
?>
<?php
require_once('/xampp/htdocs/argon/database/Connection.php');
require_once('/xampp/htdocs/argon/view/pages/categories/Categorie.class.php');

class Product
{
    //atributos
    public int $idProduto;
    public string $nomeProduto;
    public int $valorProduto;
    public int $idCategoria;

    //getters e setters
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;
    }

    public function getValorProduto()
    {
        return $this->valorProduto;
    }

    public function setValorProduto($valorProduto)
    {
        $this->valorProduto = $valorProduto;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    //metodos
    public function register($product)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO tbProduto(produto, valor, idCategoria)
                                        VALUES (?, ?, ?)");
            $stmt->bindValue(1, $product->getNomeProduto());
            $stmt->bindValue(2, $product->getIdCategoria());
            $stmt->bindValue(3, $product->getValorProduto());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function list()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT p.idProduto, p.produto, p.valor, c.nomeCategoria FROM tbproduto p
                        INNER JOIN tbcategoria c ON p.idCategoria = c.idCategoria
                            ORDER BY p.idProduto
                    ");
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function selectList()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT idCategoria, nomeCategoria FROM tbCategoria");
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editList($product)
    {
        $connection = Connection::connection();

        if (!empty($_GET['idProduto'])) {
            $idProduto = $_GET['idProduto'];

            try {
                $stmt = $connection->prepare("SELECT * FROM tbProduto WHERE idProduto='$idProduto'");
                $stmt->execute();

                if ($stmt->num_rows > 0) {

                    $stmt->bindValue(1, $product->getNomeProduto());
                    $stmt->bindValue(2, $product->getIdproduct());
                    $stmt->bindValue(3, $product->getValorProduto());
                } else {
                    header('Location: ./products.page.php');
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        try {
            $stmt = $connection->prepare("SELECT idCategoria, nomeCategoria FROM tbCategoria");
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countProducts()
    {
        $connection = Connection::connection();
        $stmt = $connection->prepare("SELECT COUNT(idProduto)
                                        AS Quantidade
                                        FROM tbProduto");
        $stmt->execute();
        return $stmt;
    }

    public function averageProducts()
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT AVG(valor) FROM tbProduto");
        $stmt->execute();

        return $stmt;
    }

    public function maxCategories()
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT DISTINCT c.nomeCategoria FROM tbProduto p
                                        INNER JOIN tbCategoria c
                                            ON p.idCategoria = c.idCategoria
                                                WHERE p.idCategoria = (SELECT COUNT(idCategoria) FROM tbproduto)
                                    ");
        
        $stmt->execute();

        return $stmt;
    }
}

<?php
require_once('/xampp/htdocs/argon/database/Connection.php');

class Categorie
{
    //atributos
    public int $idCategoria;
    public string $nomeCategoria;

    //getters e setters
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function getNomeCategoria()
    {
        return $this->nomeCategoria;
    }

    public function setNomeCategoria($nomeCategoria)
    {
        $this->nomeCategoria = $nomeCategoria;
    }

    //metodos
    public function register($categorie)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO tbCategoria(nomeCategoria)
                                        VALUES (?)");
            $stmt->bindValue(1, $categorie->getNomeCategoria());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function list()
    {
        $connection = Connection::connection();
        $stmt = $connection->prepare("SELECT * FROM tbCategoria c
                                    ORDER BY c.nomeCategoria");
        $stmt->execute();
        return $stmt;
    }

    public function countCategories()
    {
        $connection = Connection::connection();
        $stmt = $connection->prepare("SELECT COUNT(idCategoria)
                                        AS Quantidade
                                        FROM tbCategoria");
        $stmt->execute();
        return $stmt;
    }
}

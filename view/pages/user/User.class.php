<?php
require_once('/xampp/htdocs/argon/database/Connection.php');

class User
{
    //attributes
    public int $id;
    public string $name;
    public string $email;
    public string $password;

    //getters and setters 
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    //--------------------------
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    //--------------------------
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    //--------------------------
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    //--------------------------
    //methods
    public function registerUser(User $user): void
    {
        $connection = Connection::connection();

        try {
            
            $email = $user->getEmail();
            $stmt = $connection->prepare("SELECT email FROM tbUser WHERE email LIKE'%$email%'");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['statusNegative'] = "Usuário já existente, faça o cadastro novamente.";
                header('Location: /argon/register.php');
            } else {
                $stmt = $connection->prepare("INSERT INTO tbUser(name, email, password)
                                            VALUES (?, ?, ?)");
                $stmt->bindValue(1, $user->getName());
                $stmt->bindValue(2, $user->getEmail());
                $stmt->bindValue(3, $user->getPassword());

                $stmt->execute();

                $_SESSION['statusPositive'] = "Usuário cadastrado com sucesso!";
                header('Location: /argon/index.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logar(string $email, string $password)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT id, email, password FROM tbUser WHERE email LIKE'%$email%'");
        $stmt->execute();
        $listUser = $stmt->fetch(PDO::FETCH_BOTH);

        if ($stmt->rowCount() > 0) {
            if(password_verify($password, $listUser['password'])){
                session_start();

                $dados = $listUser['id'];
                
                $_SESSION['idAdm'] = $dados;
                return true;

            } else{
                return false;
            }

        } else {
            $_SESSION['statusNegative'] = "Usuário não existe, faça o cadastro.";
            header('Location: /argon/register.php');
        }
    }

    public function list($id)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT * FROM tbUser WHERE id = '$id'");
        $stmt->execute();
        $listUser = $stmt->fetch(PDO::FETCH_ASSOC);

        return $listUser;

    }
}

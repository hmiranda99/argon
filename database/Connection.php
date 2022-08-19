<?php

class Connection
{
    public static function connection()
    {

        $connection = new PDO(
            //"mysql:host=fdb33.awardspace.net;
            //dbname=3976116_bdduhel"
            //,"3976116_bdduhel"
            //,"948/73eDu88)44"

            "mysql:host=localhost;
            dbname=dbpw3"
            ,"root"
            ,""
        );

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("SET CHARACTER SET utf8");

        return $connection;
    }
}
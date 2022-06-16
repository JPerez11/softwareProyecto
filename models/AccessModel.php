<?php

    class AccessModel
    {

        private $connection;

        function __construct($connection)
        {
            $this->connection = $connection;    
        }

        function validateFormSession($email, $password)
        {
            $sql = "SELECT a.cod_acceso
                    FROM gestor.empleado e INNER JOIN gestor.acceso a
                    ON e.cod_empleado = a.cod_empleado
                    WHERE e.email = '$email' 
                    AND a.password = md5('PASSWORD' || '$password');";

            $this->connection->query($sql);

            return $this->connection->fetchAll();
        }
    }

?>
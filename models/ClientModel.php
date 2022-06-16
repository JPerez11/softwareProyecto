<?php

class ClientModel
{
    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    function fetchClient()
    {
        $sql = "SELECT * FROM gestor.cliente";

        $this->Connection->query($sql);

        return $this->Connection->fetchAll();
    }

    function addClient($document,$first_name,$last_name,$email,$cellphone)
    {
        $sql = "INSERT INTO gestor.cliente (cod_cliente, documento, nombre, apellido, email, celular)
                VALUES (DEFAULT, '$document', '$first_name', '$last_name', '$email', '$cellphone');";
        
        $this->Connection->query($sql);
    }

    function getClient($array_client)
    {
        $position = $array_client['position'];
        $value = $array_client['value'];

        $sql = "SELECT * FROM gestor.cliente WHERE $position='$value';";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function updateClient($cod_client, $document, $first_name, $last_name, $email, $cellphone)
    {
        $sql = "UPDATE gestor.cliente 
                SET documento='$document', nombre='$first_name', apellido='$last_name', email='$email', celular='$cellphone'
                WHERE cod_cliente = '$cod_client';";

        $this->Connection->query($sql);
    }
}

?>
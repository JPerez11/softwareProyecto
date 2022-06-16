<?php

class ProviderModel
{
    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    function fetchProvider()
    {
        $sql = "SELECT * FROM gestor.proveedor";

        $this->Connection->query($sql);

        return $this->Connection->fetchAll();
    }

    function addProvider($nif,$name,$direction,$email,$cellphone)
    {
        $sql = "INSERT INTO gestor.proveedor (nif, nombre, direccion, email, contacto)
                VALUES ('$nif', '$name', '$direction', '$email', '$cellphone');";
        
        $this->Connection->query($sql);
    }

    function getProvider($array_client)
    {
        $position = $array_client['position'];
        $value = $array_client['value'];

        $sql = "SELECT * FROM gestor.proveedor WHERE $position='$value';";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function updateProvider($nif, $name, $direction, $email, $cellphone)
    {
        $sql = "UPDATE gestor.proveedor 
                SET nombre='$name', direccion='$direction', email='$email', contacto='$cellphone'
                WHERE nif = '$nif';";

        $this->Connection->query($sql);
    }
}

?>
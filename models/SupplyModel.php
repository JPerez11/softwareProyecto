<?php
class SupplyModel
{
    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    function fetchSupply()
    {
        $sql = "SELECT prod.cod_producto, prod.nombre_producto, sumi.cantidad, 
        prod.precio_venta, prod.precio_compra, to_char( sumi.fecha, 'DD/MM/YYYY') AS fecha, prov.nif, prov.nombre, prod.descripcion
        FROM gestor.producto prod 
        INNER JOIN gestor.suministro sumi
        ON (prod.cod_producto = sumi.cod_producto)
        INNER JOIN gestor.proveedor prov
        ON (sumi.nif = prov.nif);";

        $this->Connection->query($sql);

        return $this->Connection->fetchAll();
    }

    function idProvider()
    {
        $sql = "SELECT nif, nombre FROM gestor.proveedor;";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function idProduct()
    {
        $sql = "SELECT cod_producto, nombre_producto FROM gestor.producto;";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function addSupply($cod_producto, $nif, $cantidad)
    {
        $sql = "INSERT INTO gestor.suministro (cod_producto, nif, fecha, cantidad)
                VALUES ($cod_producto, '$nif', now(), $cantidad);";
        
        $this->Connection->query($sql);
    }

    function getProduct($array_product)
    {
        $position = $array_product['position'];
        $value = $array_product['value'];

        $sql = "SELECT cod_producto FROM gestor.producto WHERE $position='$value';";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function getSupply($id)
    {
        list($cod_producto, $nif, $fecha) = explode(':', $id);

        $sql = "SELECT cod_producto, (SELECT nombre_producto FROM gestor.producto WHERE cod_producto = $cod_producto),
        (SELECT nombre FROM gestor.proveedor WHERE nif = '$nif'), nif, fecha, cantidad, precio_compra 
        FROM gestor.suministro 
        WHERE cod_producto = $cod_producto
        AND nif = '$nif'
        AND to_char(fecha, 'DD/MM/YYYY') = '$fecha';";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();

    }

    function updateSupply($cod_producto,$nif,$cantidad, $fecha)
    {
        $sql = "UPDATE gestor.suministro
                SET cantidad = $cantidad
                WHERE cod_producto = $cod_producto
                AND nif = '$nif'
                AND fecha = '$fecha';";

        $this->Connection->query($sql);
    }
}

?>
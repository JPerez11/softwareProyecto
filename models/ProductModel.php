<?php

    class ProductModel
    {

        private $Connection;

        function __construct($Connection)
        {
            $this->Connection = $Connection;
        }

        function fetchPorduct()
        {
            $sql = "SELECT * FROM gestor.producto;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function addProduct($nombre_producto, $precio_venta, $precio_compra, $descripcion)
        {
            $sql = "INSERT INTO gestor.producto (cod_producto, nombre_producto, precio_venta, precio_compra, descripcion)
                    VALUES (DEFAULT, '$nombre_producto', '$precio_venta', '$precio_compra', '$descripcion');";

            $this->Connection->query($sql);
        }

        function getProduct($array_product)
        {
            $position = $array_product['position'];
            $value = $array_product['value'];

            $sql = "SELECT * FROM gestor.producto WHERE $position='$value';";

            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function updateProduct($cod_producto, $nombre_producto, $precio_venta, $precio_compra, $descripcion)
        {
            $sql = "UPDATE gestor.producto
                    SET nombre_producto='$nombre_producto', precio_venta='$precio_venta', precio_compra='$precio_compra', descripcion='$descripcion'
                    WHERE cod_producto = '$cod_producto';";

            $this->Connection->query($sql);
        }
    }


?>
<?php

    class InvoiceModel
    {
        private $Connection;

        function __construct($Connection)
        {
            $this->Connection = $Connection;
        }

        function fetchInvoice()
        {
            $sql = "SELECT f.cod_factura, c.documento, f.cod_cliente, to_char(f.fecha, 'DD/MM/YYYY') AS fecha, f.descuento, f.total
            FROM gestor.factura f INNER JOIN gestor.cliente c
            ON f.cod_cliente = c.cod_cliente;";

            $this->Connection->query($sql);

            return $this->Connection->fetchAll();
        }

        function idClient()
        {
            $sql = "SELECT nombre, documento FROM gestor.cliente;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function idProduct()
        {
            $sql = "SELECT cod_producto, nombre_producto FROM gestor.producto;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }
        
        function getClient($array_cliente)
        {
            $position = $array_cliente['position'];
            $value = $array_cliente['value'];
    
            $sql = "SELECT * FROM gestor.cliente WHERE $position='$value';";

            $this->Connection->query($sql);
            
            return $this->Connection->fetchAll();
        }

        function getProduct($array_product)
        {
            $position = $array_product['position'];
            $value = $array_product['value'];

            $sql = "SELECT * FROM gestor.producto WHERE $position='$value';";

            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function addInvoice($cod_cliente)
        {
            $sql = "INSERT INTO gestor.factura (cod_factura, cod_cliente, fecha)
                    VALUES (DEFAULT, $cod_cliente, now());";
            
            $this->Connection->query($sql);
        }

        function addDetail($cod_factura, $ordinal, $cod_producto, $cantidad, $descuento)
        {
            $sql = "INSERT INTO gestor.detalle (cod_factura, ordinal, cod_producto, cantidad, descuento)
                    VALUES ($cod_factura, '$ordinal', $cod_producto, $cantidad, $descuento);";

            $this->Connection->query($sql);
        }

        function fetchInvoiceDetail($cod_factura)
        {
            $sql = "SELECT f.cod_factura, f.cod_cliente, to_char(f.fecha, 'DD/MM/YYYY') AS fecha, f.descuento, f.total, c.documento, c.nombre, c.apellido, c.email, 
                    c.celular, d.ordinal, d.cod_producto, d.cantidad, d.precio_venta, d.valor_descuento, d.subtotal, p.nombre_producto, p.descripcion
                    FROM gestor.cliente c INNER JOIN gestor.factura f
                    ON c.cod_cliente = f.cod_cliente
                    LEFT JOIN gestor.detalle d
                    ON f.cod_factura = d.cod_factura
                    LEFT JOIN gestor.producto p
                    ON d.cod_producto = p.cod_producto
                    WHERE f.cod_factura = $cod_factura;";
            
            $this->Connection->query($sql);
            
            return $this->Connection->fetchAll();
        }

        

    }

?>
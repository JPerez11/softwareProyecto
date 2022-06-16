<?php
    require_once "views/ProductView.php";
    require_once "models/ProductModel.php";

    class ProductController
    {
        function showProduct()
        {
            $ProductView = new ProductView();
            $ProductView->showProduct();
        }

        function getformProduct()
        {
            $ProductView = new ProductView();
            $ProductView->addProduct();
        }

        function addProduct()
        {
            $Connection = new Connection();

            $ProductModel = new ProductModel($Connection);

            $ProductView = new ProductView();

            $nombre_producto = strtoupper($_POST['nombre_producto']);
            $precio_venta = $_POST['precio_venta'];
            $precio_compra = $_POST['precio_compra'];
            $descripcion = $_POST['descripcion'];

            #Valida que los campos no estén vacíos
            if($nombre_producto==''){exit($this->errorTask('empty:nombre'));}
            if($precio_venta==''){exit($this->errorTask('empty:venta'));}        
            if($precio_compra==''){exit($this->errorTask('empty:compra'));}

            if($nombre_producto==''){exit($this->errorTask('product'));}
            if(!is_numeric($precio_venta)){exit($this->errorTask('value'));}
            if(!is_numeric($precio_compra)){exit($this->errorTask('value'));}

            $array_product = $ProductModel->getProduct(['position'=>'nombre_producto', 'value'=>$nombre_producto]);

            if($array_product){exit($this->errorTask('duplicity'));}

            $ProductModel->addProduct($nombre_producto, $precio_venta, $precio_compra, $descripcion);

            echo "<script>toastr.success('¡Producto guardado con exito!')</script>";

            $ProductView->showProduct();
        }

        function getProduct()
    {
        $Connection = new Connection();

        $ProductModel = new ProductModel($Connection);

        $ProductView = new ProductView();

        $cod_producto = $_POST['id'];

        $array_product = $ProductModel->getProduct(['position'=>'cod_producto', 'value'=>$cod_producto]);

        $ProductView->updateProduct($array_product);

    }

    function updateProduct()
    {
        $Connection = new Connection();

        $ProductModel = new ProductModel($Connection);

        $ProductView = new ProductView();
    
        $cod_producto = $_POST['cod_producto'];
        $nombre_producto = strtoupper($_POST['nombre_producto']);
        $precio_venta = $_POST['precio_venta'];
        $precio_compra = $_POST['precio_compra'];
        $descripcion = $_POST['descripcion'];

        #Valida que los campos no estén vacíos
        if($cod_producto==''){exit($this->errorTask('empty:codigo'));}
        if($nombre_producto==''){exit($this->errorTask('empty:nombre'));}
        if($precio_venta==''){exit($this->errorTask('empty:venta'));}        
        if($precio_compra==''){exit($this->errorTask('empty:compra'));}

        if($nombre_producto==''){exit($this->errorTask('product'));}
        if(!is_numeric($precio_venta)){exit($this->errorTask('value'));}
        if(!is_numeric($precio_compra)){exit($this->errorTask('value'));}

        $array_product = $ProductModel->getProduct(['position'=>'nombre_producto', 'value'=>$nombre_producto]);

        if($array_product){exit($this->errorTask('duplicity'));}

        $ProductModel->updateProduct($cod_producto, $nombre_producto, $precio_venta, $precio_compra, $descripcion);

        echo "<script>toastr.success('¡Producto actualizado con exito!')</script>";

        $ProductView->showProduct();
    }

        function errorTask($type)
        {
            $cadena = '';
            list($clave, $valor) = explode(':', $type);
            if ($clave == 'empty')
            {
                switch ($valor) {
                    case 'nombre':
                        $cadena = 'El campo del nombre no puede estar vacío';
                        break;
                    case 'compra':
                        $cadena = 'El campo del precio de compra no puede estar vacío';
                        break;                
                    case 'venta':
                        $cadena = 'El campo del precio de venta no puede estar vacio';
                        break;
                    case 'codigo':
                        $cadena = 'El campo del codigo no puede estar vacío';
                        break;
                    case 'fecha':
                        $cadena = 'El campo de la fecha no puede estar vacío';
                        break; 
                    default:
                        $cadena = '';
                        break;
                }
            }
            elseif($type == 'duplicity')
            {
                $cadena = '¡El producto ya existe en la base de datos!';
            } elseif($type == 'product')
            {
                $cadena = '¡El nombre del producto es obligatorio!';
            } elseif($type == 'value')
            {
                $cadena = '¡El valor debe ser numérico!';
            }
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: '$cadena',
                icon: 'error',
                confirmButtonText: 'Confirmar'
            })
                </script>";
            $ProductView = new ProductView();
            $ProductView->showProduct();

        }
    }
?>
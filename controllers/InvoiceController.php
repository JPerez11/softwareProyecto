<?php
require_once 'models/InvoiceModel.php';
require_once 'views/InvoiceView.php';
    class invoiceController
    {
        function showInvoice()
        {
            $InvoiceView = new InvoiceView();
            $InvoiceView->showInvoice();
        }

        function getFormInvoice()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $id_cliente = $InvoiceModel->idClient();
            $InvoiceView = new InvoiceView();
            $InvoiceView->addInvoice($id_cliente);
        }
        
        function getFormDetail()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $id_producto = $InvoiceModel->idProduct();
            $InvoiceView = new InvoiceView();
            $InvoiceView->addDetail($id_producto, $_POST['id']);
        }

        function addInvoice()
        {
            $Connection = new Connection();

            $InvoiceModel = new InvoiceModel($Connection);

            $InvoiceView = new InvoiceView();

            $documento = $_POST['documento'];

            #Valida que los campos no estén vacíos
            if($documento==''){exit($this->errorTask('empty:documento'));}

            $array_document = $InvoiceModel->getClient(['position'=>'documento', 'value'=>$documento]);

            $cod_cliente = $array_document[0]->cod_cliente;

            $InvoiceModel->addInvoice($cod_cliente);

            echo "<script>toastr.success('¡Factura creada con exito!')</script>";

            $InvoiceView->showInvoice();
        }

        function addDetail()
        {
            $Connection = new Connection();

            $InvoiceModel = new InvoiceModel($Connection);

            $InvoiceView = new InvoiceView();

            $cod_factura = $_POST['cod_factura'];
            $ordinal = $_POST['ordinal'];
            $nombre_producto = strtoupper($_POST['producto']);
            $cantidad = $_POST['cantidad'];
            $descuento = $_POST['descuento'];

            #Valida que los campos no estén vacíos
            if($cod_factura==''){exit($this->errorTask('empty:factura'));}
            if($ordinal==''){exit($this->errorTask('empty:ordinal'));}
            if($nombre_producto==''){exit($this->errorTask('empty:producto'));}
            if($cantidad==''){exit($this->errorTask('empty:cantidad'));}
            if($descuento==''){exit($this->errorTask('empty:descuento'));}

            $array_product = $InvoiceModel->getProduct(['position'=>'nombre_producto', 'value'=>$nombre_producto]);

            $cod_producto = $array_product[0]->cod_producto;
            
            echo "<script>toastr.success('¡Producto facturado con exito!')</script>";

            $InvoiceModel->addDetail($cod_factura, $ordinal, $cod_producto, $cantidad, $descuento);

            $InvoiceView->showInvoice();

        }

        function showInvoiceDetail()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $array_venta = $InvoiceModel->fetchInvoiceDetail($_POST['id']);
            $InvoiceView = new InvoiceView();
            $InvoiceView->showInvoiceDetail($array_venta);
        }

        function errorTask($type)
        {
            $cadena = '';
            list($clave, $valor) = explode(':', $type);
            if ($clave == 'empty')
            {
                switch ($valor) {
                    case 'documento':
                        $cadena = 'El campo del documento no puede estar vacío';
                        break;
                    case 'factura':
                        $cadena = 'El campo de la factura no puede estar vacío';
                        break;
                    case 'ordinal':
                        $cadena = 'El campo del ordinal no puede estar vacío';
                        break;
                    case 'producto':
                        $cadena = 'El campo del producto no puede estar vacío';
                        break;
                    case 'cantidad':
                        $cadena = 'El campo de la cantidad no puede estar vacío';
                        break; 
                    case 'descuento':
                        $cadena = 'El campo del descuento no puede estar vacío';
                        break; 
                    default:
                        $cadena = '';
                        break;
                }
            }
            elseif($type == 'duplicity')
            {
                $cadena = 'El proveedor ya existe en la base de datos';
            } elseif($type == 'documento')
            {
                $cadena = 'El documento es obligatorio';
            } elseif($type == 'email')
            {
                $cadena = 'Email mal estructurado';
            } elseif($type == 'cellphone')
            {
                $cadena = 'El celular debe ser numérico';
            }
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: '$cadena',
                icon: 'error',
                confirmButtonText: 'Confirmar'
            })
                </script>";
                $InvoiceView = new InvoiceView();
                $InvoiceView->showInvoice();

        }
    }
?>
<?php
require_once "views/SupplyView.php";
require_once "models/SupplyModel.php";

class SupplyController
{
    function showSupply()
    {
        $SupplyView = new SupplyView();
        $SupplyView->showSupply();
    }

    function formSupply()
    {
        $SupplyView = new SupplyView();
        $SupplyView->addSupply();
    }

    function addSupply() {
        
        $Connection = new Connection();

        $SupplyModel = new SupplyModel($Connection);

        $SupplyView = new SupplyView();

        $nombre_producto = strtoupper($_POST['nombre_producto']);
        $nif = strtoupper($_POST['nif']);
        $cantidad = $_POST['cantidad'];

        #Valida que los campos no estén vacíos
        if($nombre_producto==''){exit($this->errorTask('empty:nombre'));}
        if($nif==''){exit($this->errorTask('empty:nif'));}        
        if($cantidad==''){exit($this->errorTask('empty:cantidad'));}

        if($nombre_producto == ''){exit($this->errorTask('producto'));}
        if($nif==''){exit($this->errorTask('nif'));}
        if(!is_numeric($cantidad)){exit($this->errorTask('cantidad'));}

        $array_product = $SupplyModel->getProduct(['position'=>'nombre_producto', 'value'=>$nombre_producto]);

        $cod_producto = $array_product[0]->cod_producto;

        $SupplyModel->addSupply($cod_producto,$nif,$cantidad);

        echo "<script>toastr.success('¡Suministro registrado con exito!')</script>";

        $SupplyView->showSupply();

    }

    function getSupply()
    {
        $Connection = new Connection();

        $SupplyModel = new SupplyModel($Connection);

        $SupplyView = new SupplyView();

        $array_supply = $SupplyModel->getSupply($_POST['id']);

        $SupplyView->getSupply($array_supply);

    }

    function updateSupply() {
        
        $Connection = new Connection();

        $SupplyModel = new SupplyModel($Connection);

        $SupplyView = new SupplyView();

        $cod_producto = strtoupper($_POST['cod_producto']);
        $nif = strtoupper($_POST['nif']);
        $fecha = $_POST['fecha'];
        $cantidad = $_POST['cantidad'];
        
        #Valida que los campos no estén vacíos
        if($nif==''){exit($this->errorTask('empty:nif'));}
        if($cod_producto==''){exit($this->errorTask('empty:codigo_producto'));}
        if($fecha==''){exit($this->errorTask('empty:fecha'));}
        if($cantidad==''){exit($this->errorTask('empty:cantidad'));}

        if(!is_numeric($cantidad)){exit($this->errorTask('cantidad'));}


        $SupplyModel->updateSupply($cod_producto,$nif,$cantidad, $fecha);

        $SupplyView->showSupply();

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
                case 'nif':
                    $cadena = 'El campo del proveedor no puede estar vacío';
                    break;                
                case 'cantidad':
                    $cadena = 'El campo de la cantidad no puede estar vacío';
                    break;
                case 'codigo_producto':
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
        elseif($type == 'producto')
        {
            $cadena = 'El producto es obligatorio';
        } elseif($type == 'nif')
        {
            $cadena = 'El proveedor es obligatorio';
        } elseif($type == 'cantidad')
        {
            $cadena = 'La cantidad debe ser numérico';
        }
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: '$cadena',
            icon: 'error',
            confirmButtonText: 'Confirmar'
          })
            </script>";
        $SupplyView = new SupplyView();
        $SupplyView->showSupply();

    }
}

?>
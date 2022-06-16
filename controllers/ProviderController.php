<?php
require_once 'models/ProviderModel.php';
require_once 'views/ProviderView.php';
class ProviderController
{
    function showProvider()
    {
        $ProviderView = new ProviderView();
        $ProviderView->showProvider();
    }

    function formProvider()
    {
        $ProviderView = new ProviderView();
        $ProviderView->addProvider();
    }

    function addProvider()
    {
        $Connection = new Connection();

        $ProviderModel = new ProviderModel($Connection);

        $ProviderView = new ProviderView();

        $nif = strtoupper($_POST['nif']);
        $name = strtoupper($_POST['name']);
        $direction = strtoupper($_POST['direction']);
        $email = strtoupper($_POST['email']);
        $cellphone= $_POST['cellphone'];

        #Valida que los campos no estén vacíos
        if($nif==''){exit($this->errorTask('empty:nif'));}
        if($name==''){exit($this->errorTask('empty:nombre'));}
        if($direction==''){exit($this->errorTask('empty:direccion'));}
        if($email==''){exit($this->errorTask('empty:email'));}
        if($cellphone==''){exit($this->errorTask('empty:celular'));}

        if($nif==''){exit($this->errorTask('nif'));}
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){exit($this->errorTask('email'));}
        if(!is_numeric($cellphone)){exit($this->errorTask('cellphone'));}

        $array_provider = $ProviderModel->getProvider(['position'=>'nif', 'value'=>$nif]);

        if($array_provider){exit($this->errorTask('duplicity'));}

        $ProviderModel->addProvider($nif,$name,$direction,$email,$cellphone);

        echo "<script>toastr.success('¡Proveedor guardado con exito!')</script>";

        $ProviderView->showProvider();

    }

    function getProvider()
    {
        $Connection = new Connection();

        $ProviderModel = new ProviderModel($Connection);

        $ProviderView = new ProviderView();

        $nif = $_POST['id'];

        $array_provider = $ProviderModel->getProvider(['position'=>'nif', 'value'=>$nif]);

        $ProviderView->getProvider($array_provider);

    }

    function updateProvider()
    {
        $Connection = new Connection();

        $ProviderModel = new ProviderModel($Connection);

        $ProviderView = new ProviderView();
        
        $nif = strtoupper($_POST['nif']);
        $name = strtoupper($_POST['name']);
        $direction = strtoupper($_POST['direction']);
        $email = strtoupper($_POST['email']);
        $cellphone= $_POST['cellphone'];

        #Valida que los campos no estén vacíos
        if($nif==''){exit($this->errorTask('empty:nif'));}
        if($name==''){exit($this->errorTask('empty:nombre'));}
        if($direction==''){exit($this->errorTask('empty:direccion'));}
        if($email==''){exit($this->errorTask('empty:email'));}
        if($cellphone==''){exit($this->errorTask('empty:celular'));}

        if($nif==''){exit($this->errorTask('nif'));}
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){exit($this->errorTask('email'));}
        if(!is_numeric($cellphone)){exit($this->errorTask('cellphone'));}

        $array_provider = $ProviderModel->getProvider(['position'=>'nif', 'value'=>$nif]);

        if($array_provider){exit($this->errorTask('duplicity'));}

        $ProviderModel->updateProvider($nif, $name, $direction, $email, $cellphone);

        echo "<script>toastr.success('¡Proveedor actualizado con exito!')</script>";

        $ProviderView->showProvider();

    }

    function errorTask($type)
    {
        $cadena = '';
        list($clave, $valor) = explode(':', $type);
        if ($clave == 'empty')
        {
            switch ($valor) {
                case 'nif':
                    $cadena = 'El campo del nif no puede estar vacío';
                    break;
                case 'nombre':
                    $cadena = 'El campo del nombre no puede estar vacío';
                    break;
                case 'direccion':
                    $cadena = 'El campo de la dirección no puede estar vacío';
                    break;
                case 'email':
                    $cadena = 'El campo del email no puede estar vacío';
                    break;
                case 'celular':
                    $cadena = 'El campo del celular no puede estar vacío';
                    break; 
                default:
                    $cadena = '';
                    break;
            }
        }
        elseif($type == 'duplicity')
        {
            $cadena = 'El proveedor ya existe en la base de datos';
        } elseif($type == 'nif')
        {
            $cadena = 'El NIF es obligatorio';
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
        $ProviderView = new ProviderView();
        $ProviderView->showProvider();

    }
}

?>
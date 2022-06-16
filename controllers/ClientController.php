<?php
require_once 'models/ClientModel.php';
require_once 'views/ClienteView.php';
class ClientController
{
    function showClient()
    {
        $ClientView = new ClientView();
        $ClientView->showClient();
    }

    function getFormClient()
    {
        $ClientView = new ClientView();
        $ClientView->addClient();
    }

    function addClient()
    {
        $Connection = new Connection();

        $ClientModel = new ClientModel($Connection);

        $ClientView = new ClientView();

        $document = $_POST['document'];
        $first_name = strtoupper($_POST['first_name']);
        $last_name = strtoupper($_POST['last_name']);
        $email = strtoupper($_POST['email']);
        $cellphone= $_POST['cellphone'];

        #Valida que los campos no estén vacíos
        if($document==''){exit($this->errorTask('empty:documento'));}
        if($first_name==''){exit($this->errorTask('empty:nombres'));}
        if($last_name==''){exit($this->errorTask('empty:apellidos'));}
        if($email==''){exit($this->errorTask('empty:email'));}
        if($cellphone==''){exit($this->errorTask('empty:celular'));}
        
        if(!is_numeric($document)){exit($this->errorTask('document'));}
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){exit($this->errorTask('email'));}
        if(!is_numeric($cellphone)){exit($this->errorTask('cellphone'));}

        $array_client = $ClientModel->getClient(['position'=>'documento', 'value'=>$document]);

        if($array_client){exit($this->errorTask('duplicity'));}

        $ClientModel->addClient($document,$first_name,$last_name,$email,$cellphone);

        echo "<script>toastr.success('¡Cliente guardado con exito!')</script>";

        $ClientView->showClient();

    }

    function getClient()
    {
        $Connection = new Connection();

        $ClientModel = new ClientModel($Connection);

        $ClientView = new ClientView();

        $cod_client = $_POST['id'];

        $array_client = $ClientModel->getClient(['position'=>'cod_cliente', 'value'=>$cod_client]);

        $ClientView->getClient($array_client);

    }

    function updateClient()
    {
        $Connection = new Connection();

        $ClientModel = new ClientModel($Connection);

        $ClientView = new ClientView();
        
        $cod_client = $_POST['cod_client'];
        $document = $_POST['document'];
        $first_name = strtoupper($_POST['first_name']);
        $last_name = strtoupper($_POST['last_name']);
        $email = strtoupper($_POST['email']);
        $cellphone= $_POST['cellphone'];

        #Valida que los campos no estén vacíos
        if($document==''){exit($this->errorTask('empty:documento'));}
        if($first_name==''){exit($this->errorTask('empty:nombres'));}
        if($last_name==''){exit($this->errorTask('empty:apellidos'));}
        if($email==''){exit($this->errorTask('empty:email'));}
        if($cellphone==''){exit($this->errorTask('empty:celular'));}

        if(!is_numeric($document)){exit($this->errorTask('document'));}
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){exit($this->errorTask('email'));}
        if(!is_numeric($cellphone)){exit($this->errorTask('cellphone'));}

        $array_client = $ClientModel->getClient(['position'=>'documento', 'value'=>$document]);

        if($array_client){exit($this->errorTask('duplicity'));}

        $ClientModel->updateClient($cod_client, $document, $first_name, $last_name, $email, $cellphone);

        echo "<script>toastr.success('¡Cliente actualizado con exito!')</script>";

        $ClientView->showClient();

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
                case 'nombres':
                    $cadena = 'El campo de los nombres no puede estar vacío';
                    break;
                case 'apellidos':
                    $cadena = 'El campo de los apellidos no puede estar vacío';
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
            $cadena = 'El documento ya existe en la base de datos';
        } elseif($type == 'document')
        {
            $cadena = 'El documento debe ser un número';
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
        $ClientView = new ClientView();
        $ClientView->showClient();

    }
}

?>
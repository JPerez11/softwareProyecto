<?php

require_once "models/AccessModel.php";
require_once "views/AccessView.php";
    class AccessController
    {

        function showFormSession()
        {
            $AccessView = new AccessView();
            $AccessView->showFormSession();
        }

        function validateFormSession($array)
        {

            $Connection = new Connection();
            
            $email = strtoupper($array['email']);
            $password = $array['password'];

            if(empty($email)){exit("El usuario es obligatorio");}
            if(empty($password)){exit("La clave es obligatoria");}
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){exit("Correo mal estructurado");}

            $AccessModel = new AccessModel($Connection);
            
            $array_access = $AccessModel->validateFormSession($email,$password);
            if ($array_access) {
                $_SESSION['cod_acceso']=$array_access[0]->cod_acceso;
                $_SESSION['auth']='OK';
            }
            header('Location: index.php');
        }

        function closeSession()
        {
            session_unset();
            session_destroy();
            $_SESSION = array();
        }

    }


?>
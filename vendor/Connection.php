<?php
require_once '../private_files_softwareProyecto/setting_connection.php';
class Connection
{
    private $connection;
    private $result;

    function __construct()
    {
        $this->connectDataBase();
    }

    function connectDataBase(){
        $host = HOST;
        $user = USER;
        $pass = PASS;
        $db = DB;
        $port = PORT;

        try {
            $this->connection= new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
        } catch (\Throwable $e) {
            echo "Ocurre un error con la base de datos ".$e->getMessage();
        }
    }

    function query($sql)
    {
        $this->result=$this->connection->query($sql) or exit('Consulta mal estructurada');
    }

    function fetchAll()
    {
        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }
}

?>
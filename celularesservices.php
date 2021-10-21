<?php
require_once 'connection.php';
require_once 'lib/nusoap.php';

function insertCels($marca, $modelo, $precio){
    try{
        $connection = new Connection();
        $consult = $connection->prepare("INSERT INTO caracteristicas (
        Marca, Modelo, Precio) VALUES(:marca, :modelo, :precio)");
        $consult -> bindParam(":marca", $marca, PDO::PARAM_STR);
        $consult -> bindParam(":modelo", $modelo, PDO::PARAM_STR);
        $consult -> bindParam(":precio", $precio, PDO::PARAM_INT);

        $consult -> execute();
        $lastId = $connection -> lastInsertId();
        return join(",", array($lastId));
    }catch(Exception $e){
        return join(",", array(false));

    }
}

$server = new nusoap_server();
$server -> configureWSDL("celularesservices","urn:celularesservices");

$server -> register("insertCels",
    array("marca" => "xsd:string", "modelo" => "xsd:string", "precio" => "xsd:int"),
    array("return" => "xsd:string"),
    "urn:celularesservices",
    "urn:celularesservices#insertCels",
    "rcp",
    "encoded",
    "Metodo para insertar un celular"
);
    


$post = file_get_contents('php://input');
$server -> service($post);


?>
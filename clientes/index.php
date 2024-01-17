<?php
    require_once("../cors.php");
    require_once("../api.php");
    //require_once("authcontroller.php");
    require_once("../conexion.php");
    header('Content-Type: application/json; charset=utf-8');
    $url=$_SERVER['REQUEST_URI'];
    $methodHTTP=$_SERVER['REQUEST_METHOD'];
    if($url=='/api/clientes/' && $methodHTTP=='GET'){
        $clientes=array();
        $api= new Api();
        $clientes= $api->getClientes();
        echo json_encode($clientes);
    }
    if($url == '/api/clientes/' && $methodHTTP == 'POST')
    {
        $data = $_POST;
        $api= new Api();
        $result = $api->saveClientes($data);
        echo $result;
    }
    if(!empty($_GET['cliente_id']) && $methodHTTP=='GET'){
        $data=$_GET;
        $api= new Api();
        $result= $api->getClienteId($data);
        echo json_encode($result);
    }

    if($methodHTTP=='DELETE'){
        $data = $_GET;
        $api= new Api();
        $result= $api->deleteCliente($data);
        echo json_encode($result);
    }
?>

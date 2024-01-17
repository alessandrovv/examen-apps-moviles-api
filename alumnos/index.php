<?php
    require_once("../cors.php");
    require_once("../api.php");
    //require_once("authcontroller.php");
    require_once("../conexion.php");
    header('Content-Type: application/json; charset=utf-8');
    $url=$_SERVER['REQUEST_URI'];
    $methodHTTP=$_SERVER['REQUEST_METHOD'];
    if($url=='/api/alumnos/' && $methodHTTP=='GET'){
        $alumnos=array();
        $api= new Api();
        $alumnos= $api->getAlumnos();
        echo json_encode($alumnos);
    }
    if($url == '/api/alumnos/' && $methodHTTP == 'POST')
    {
        $data = $_POST;
        $api= new Api();
        $result = $api->saveAlumnos($data);
        echo $result;
    }
    if(!empty($_GET['id']) && $methodHTTP=='GET'){
        $data=$_GET;
        $api= new Api();
        $result= $api->getAlumnoId($data);
        echo json_encode($result);
    }

    if($methodHTTP=='DELETE'){
        $data = $_GET;
        $api= new Api();
        $result= $api->deleteAlumno($data);
        echo json_encode($result);
    }
?>

<?php
require_once __DIR__ . "/../controllers/UsuarioController.php";

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];

if($rota === "usuario"){
    switch($metodo){
        case "POST":
            createUsuario($con);
            break;
        case "GET":
            readUsuario($con);
            break;
        case "PUT":
            updateUsuario($con);
            break;
        case "DELETE":
            deleteUsuario ($con);
            break;
        default:
            teste();
    }
}else if ($rota === "Publicacoes"){
   switch($metodo){
        case "POST":
            createPublicacoes($con);
            break;
        case "GET":
            readPublicacoes($con);
            break;
        case "PUT":
            updatePublicacoes($con);
            break;
        case "DELETE":
            deletePublicacoes($con);
            break;
        default:
            teste();

    } 
}else if ($rota === "Curtidas"){
   switch($metodo){
        case "POST":
            createCurtidas($con);
            break;
        case "GET":
            readCurtidas($con);
            break;
        case "PUT":
            updateCurtidas($con);
            break;
        case "DELETE":
            deleteCurtidas($con);
            break;
        default:
            teste();

    } 
    }
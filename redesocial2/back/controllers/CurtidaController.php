<?php
require_once __DIR__ . "/../models/CurtidaModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondendo"
    ]);
    exit;
}
// Receber e validar os dados 
function receberDadosCurtidas(){
    $dados= json_decode(
        file_get_contents("php://input"), true);
    if(!is-array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro" => "Envie um objeto JSON com dados!"
        ]);
    return null;
    }
    //nome, username, email e senha ->se existe
    foreach (["id_usuario", "id_publicacao", "data_curtida"] as $campo) {
        if(!isset($dados[$campo]) || 
        trim($dados[$campo]) ===""){
            http_response_code(400);
            echo json_encode([
                "erro" =>
                "o campo $campo é obrigatorio e deve ser um texto!"
            ]);
            return null;
        }
    }
    return $dados;
}

function ReceberIdCurtidas(){
    $id = filter_var($_GET[$id] ?? null,
        FILTER_VALIDATE_INT,
        ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "iniforme um id de curtida valido"
        ]);
        return null;
    }
    return $id;
}

function createCurtidas($con){
    $dados = receberDadosCurtidas();
    if ($dados === null){
        return;
    }
    $id = inserir($con, $dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Curtida dada com sucesso",
        "$id" => $id
    ]);

}

function readCurtidas($con){
    echo json_encode(listar($con));
}

function updateCurtidas($con){
    $id = receberIdCurtidas();
    if($id === null){
        return;
    }
    $dados = receberDadosCurtidas();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Senha alterada com sucesso!"
    ]);
}

function deleteCurtada($con){
    $id = ReceberIdCurtidas();
    if($id === null){
        return;
    }
    remover ($con, $id);
    echo json_encode([
        "mensagem" => "Curtida removida com sucesso!"
    ]);
}
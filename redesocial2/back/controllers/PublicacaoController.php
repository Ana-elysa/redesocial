<?php
require_once __DIR__ . "/../models/PublicacaoModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondendo"
    ]);
    exit;
}

// Receber e validar os dados 
function receberDadosPublicacao(){
    $dados= json_decode(
        file_get_contents("php://input"), true);
    if(!is-array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro" => "Envie um objeto JSON com dados!"
        ]);
    return null;
    }

    foreach (["id_usuario", "legenda", "imagem_url","data_publicacao"] as $campo) {
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

function ReceberIdPublicacao(){
    $id = filter_var($_GET[$id] ?? null,
        FILTER_VALIDATE_INT,
        ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "iniforme um id de Publicação valido"
        ]);
        return null;
    }
    return $id;
}

function createPublicacao($con){
    $dados = receberDadosPublicacao();
    if ($dados === null){
        return;
    }
    $id = inserir($con, $dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Publicação criado com sucesso",
        "$id" => $id
    ]);

}

function readPublicacao($con){
    echo json_encode(listar($con));
}

function updatePublicacao($con){
    $id = ReceberIdPublicacao();
    if($id === null){
        return;
    }
    $dados = receberDadosPublicacao();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Senha alterada com sucesso!"
    ]);
}

function deletePublicacao($con){
    $id = ReceberIdPublicacao();
    if($id === null){
        return;
    }
    remover ($con, $id);
    echo json_encode([
        "mensagem" => "Publicação removido com sucesso!"
    ]);
}
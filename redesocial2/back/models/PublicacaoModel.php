<?php
//CREATE
function inserir($con,$dados){
    $stmt = $con->prepare(
        "INSERT INTO PUBLICACOES (id_usuario, legenda, imagem_url, data_publicacao)
        VALUES (?,?,?,?)"
    );
    $stmt -> execute([  $dados["id_usuario"],
                        $dados["legenda"],
                        $dados["imagem_url"], 
                        $dados["data_publicacao"]]);
    return $con->lastInsertId();
}
//READ
function listar($con){
    $stmt = $con -> query("SELECT * FROM publicacoes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}
//UPDATE 
function atualizar($con,$id,$dados){
    $stmt =$con->prepare(
        "UPDATE usuarios SET id_usuario = ?, legenda = ?, imagem_url = ?, data_publicacao = ?
        WHERE id_Publicacao = ?"
    );
    $stmt -> execute([  $dados["id_usuario"], 
                       $dados["legenda"], 
                       $dados["imagem_url"], 
                       $dados["data_publicacao"],
                        $id]);
}
//DELETE
function deletar($con, $id){
    $stmt= $con -> prepare(
        "DELETE FROM publicacoes WHERE id_Publicacao = ? "
    );
    $stmt -> execute([$id]);

}
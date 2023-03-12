<?php
require_once '../modelo/usuario.php';
require_once 'bd.php';

// recuperar dados do usuario e validar sua senha
function consultar(string $nomeUsuario) {

    $stmt = null;
    $objUsuario = null;

    // conectar BD
    $con = conectarBD();

    // executar a query
    $stmt = $con->prepare("SELECT * FROM usuarios WHERE nome = :nomeUsuario");
    $stmt->bindParam(':nomeUsuario', $nomeUsuario);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {
        // define a classe para os objetos a serem criados (utilizar o namespace)
        $stmt->setFetchMode( PDO::FETCH_CLASS, "Mcosf\Testes\Usuario");
        $objUsuario = $stmt->fetch();
    }

    // desconectar BD
    desconectarBD($con);

    return $objUsuario;

}
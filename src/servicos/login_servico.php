<?php

require_once '../modelo/usuario.php';
require_once '../bd/usuario_bd.php';
require_once 'log.php';

/* verifica se uma sessao esta criada, validando a entrada, caso contrario vai para o login */
session_start();
$sessaoValida = isset($_SESSION['idSessao']) ? $_SESSION['idSessao'] === session_id() : FALSE;

if ( $sessaoValida != true ) {
    $_SESSION['idSessao'] = session_id();
} else {
    // detroy a sessao e reinicia o login
    session_destroy();
    header('Location: ../login.php');
    exit();
}


/* receber nome do professor do formulario HTML */
$usuarioForm  = $_POST['usuario'];
$senhaForm = $_POST['senha'];

 // buscar o usuario no BD
$objUsuario = consultar($usuarioForm);

// valida o usuario e a senha do usuario
if ( $objUsuario != NULL ) {

    // calcula o hash da senha informada
    $hashSenha = hash( 'sha256', $senhaForm );

    $senhaUsuario = $objUsuario->getSenha();

    // comparando duas strings de forma binaria
    if ( strcmp( $hashSenha, $senhaUsuario ) == 0 ) {

        // logando o nome do usuario
        logMsg('Usuario logado: ' . $objUsuario->getNome(), 'info');

        // armazena o objeto com o Usuario na sessao
        // nao esqueca de "serializar" o objeto
        $_SESSION['usuarioLogado'] = serialize($objUsuario);

        // desvia para a pagina principal (home.php)
        header('location: ../home.php');

    } else {
        
        // mensagem de retorno
        $mensagemRetorno = 'Usuário ou senha inválidos';

        // armazena o valor da mensagem de retorno na sessao
        $_SESSION['mensagemRetorno'] = $mensagemRetorno;

        // logando o nome do usuario e o erro
        logMsg('Usuario: ' . $usuarioForm, 'info');
        logMsg($mensagemRetorno, 'info');

        // desvia para a pagina login.php com mensagem de erro
        header('location: ../login.php'); 

    }

} else {
    
    $mensagemRetorno = 'Usuário não cadastrado';

    // armazena o valor da mensagem de retorno na sessao
    $_SESSION['mensagemRetorno'] = $mensagemRetorno;

    // logando o nome do usuario e o erro
    logMsg('Usuario: ' . $usuarioForm, 'info');
    logMsg($mensagemRetorno, 'info');

    // desvia para a pagina login.php com mensagem de erro
    header('location: ../login.php');

}

return;


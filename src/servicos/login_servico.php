<?php

require_once '../modelo/usuario.php';
require_once '../bd/usuario_bd.php';
require_once 'log.php';

/* criar uma sessao */
session_start();

/* receber nome do professor do formulario HTML */
$usuarioForm  = $_POST['usuario'];
$usuarioSenha = $_POST['senha'];

 // buscar o usuario no BD
$objUsuario = consultar($usuarioForm);

// valida o usuario e a senha do usuario
if ( $objUsuario != NULL ) {

    // calcula o hash da senha informada
    // comparando duas strings de forma binaria

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


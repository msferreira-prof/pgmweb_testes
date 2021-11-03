<?php

/* insere apenas uma vez os arquivos com as funcoes e classes utilizadas */
require_once '../bd/professor_bd.php';

/* verifica se uma sessao esta criada, validando a entrada, caso contrario vai para o login */
session_start();
$sessaoValida = isset($_SESSION['idSessao']) ? $_SESSION['idSessao'] === session_id() : FALSE;

if ( $sessaoValida != true ) {
   header('Location: ../login.php');
   exit();
}

// recupera a matricula do professor
$matriculaProfessor = $_GET['matriculaProfessor'];

// define nome e baixa a imagem
$imagem = baixarImagemProfessor($matriculaProfessor);

// define o tipo de arquivo que sera baixado pelo navegador
header( 'Content-Type: application/octet-stream;' );

// Indica o nome do arquivo como sera "baixado"
header( 'Content-Disposition: attachment; filename='.$imagem );

// Indica ao navegador qual é o tamanho do arquivo
header( 'Content-Length: '.filesize($imagem) );

// Busca todo o arquivo
readfile($imagem);
    
exit;




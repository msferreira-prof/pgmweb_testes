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

/* lista os professores */
$professores = listar();

$_SESSION['professores'] = $professores;

header('location: ../listarProfessor_bs.php');

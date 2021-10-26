<?php
/* Caso de Teste - Validacao Duplicidade de Nome de Professor */

use Mcosf\Testes\Professor;

require '../bd/bd.php';

// preparar o cenario / GIVEN
$nomeProfessor     = 'Augusto Joana';
$nomeProfessorLido = '';

// conectar BD
$con = conectarBD();

// executar a query
$stmt = $con->prepare('SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor');
$stmt->bindParam(':nomeProfessor', $nomeProfessor);

// executar o codigo a ser testado / WHEN
$stmt->execute();

$count = $stmt->rowCount();

// desconectar BD
desconectarBD($con);

if ($count > 0) {
    $stmt->setFetchMode( PDO::FETCH_CLASS, 'professor');
    $objProfessor = $stmt->fetch();
    $nomeProfessorLido = $objProfessor['nome'];
}

// comparando 2 strings
// verificar se a execucao atende ou nao ao teste proposto
// verificar se o resultado eh o esperado / THEN
if ( strcmp($nomeProfessor, $nomeProfessorLido) == 0 ) {
    echo "Foi encontrado";
// } else {
//     echo 'Nao foi encontrado';
}


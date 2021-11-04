<?php

/* insere apenas uma vez os arquivos com as funcoes e classes utilizadas */
require_once '../modelo/professor.php';
// require_once '../bd/professor_bd.php';
require_once '../bd/bd.php';

use Mcosf\Testes\Professor;

// incluir professor
function incluir(string $nomeProfessor, $fotoProfessor) {

    // prepara a foto
    $mySqlImg = NULL;
    if ( $fotoProfessor != NULL ) {

        // gera um nome de arquivo novo baseado na hora do servidor
        $path = $fotoProfessor['name'];
        $extensao = pathinfo($path, PATHINFO_EXTENSION); // recupera a extensao do arquivo recebido
        $nomeFoto = time() . '.' . $extensao;

        // move a imagem para uma area de downlods na aplicacao
        if ( move_uploaded_file( $fotoProfessor['tmp_name'], '../uploads/' . $nomeFoto) ) {

            // recupera o tamanho do arquivo
            $tamanhoImagem = filesize('../uploads/'. $nomeFoto);

            // abre o arquivo, le todo o conteudo para a variavel $mySqlImg e fecha o arquivo
            $handle = fopen('../uploads/' . $nomeFoto, "r");
            $mySqlImg = fread($handle, $tamanhoImagem);
            fclose($handle);

        }
    }
    
    // conectar BD
    $con = conectarBD();

    // executar a query
    $stmt = $con->prepare("INSERT INTO professores (matricula, nome, nomeFoto, foto) VALUES (DEFAULT, ?, ?, ?)");
    $stmt->bindParam(1, $nomeProfessor, PDO::PARAM_STR); // define o tipo de parametro - String
    $stmt->bindParam(2, $nomeFoto, PDO::PARAM_STR); // define o tipo de parametro como String    '../uploads/' . 
    $stmt->bindParam(3, $mySqlImg, PDO::PARAM_LOB); // define o tipo de parametro como LOB - Large Object

    if ( $stmt->execute() ) {
        // recuperar o codigo gerado 
        $matriculaGerada = $con->lastInsertId();
    }
    
    // liberar o objeto de execucao da query
    $stmt = null;

    // desconectar BD
    desconectarBD($con);

    // montar o objeto professor
    $objProfessor = new Professor();
    $objProfessor->setMatricula($matriculaGerada);
    $objProfessor->setNome($nomeProfessor);
    $objProfessor->setNomeFoto($nomeFoto);

    return $objProfessor;
}


// listar professor
function listar() {
    $stmt = null;
    $registros = null;

    // conectar BD
    $con = conectarBD();

    // listar professores
    $stmt = $con->prepare("SELECT matricula, nome, nomeFoto FROM professores");
    if ( $stmt->execute() ) {
        $registros = $stmt->fetchAll( PDO::FETCH_CLASS, "Mcosf\Testes\Professor");
    }

    // desconectar BD
    desconectarBD($con);

    return $registros;

}

// validar nome duplicado retornando verdadeiro ou falso
function validarNomeDuplicado(string $nomeProfessor) {
    $retorno = false;

    $stmt = null;
    $registros = null;

    // conectar BD
    $con = conectarBD();
    
    // executar a query
    $stmt = $con->prepare("SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor ");
    $stmt->bindParam(':nomeProfessor', $nomeProfessor);

    if ( $stmt->execute() ) {
        $registros = $stmt->fetchAll( PDO::FETCH_CLASS, "Mcosf\Testes\Professor" );
    
        if ( $registros != null and sizeof($registros) > 0 ) {
            $retorno = true;
        } else {
            $retorno = false;
        }
    }
    
    return $retorno;
}

// validar nome duplicado retornando um objeto
function validarNomeDuplicadoV2(string $nomeProfessor) {
    $retorno = null;

    $stmt = null;
    $registros = null;

    // conectar BD
    $con = conectarBD();
    
    // executar a query
    $stmt = $con->prepare("SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor ");
    $stmt->bindParam(':nomeProfessor', $nomeProfessor);

    if ( $stmt->execute() ) {
        $registros = $stmt->fetchAll( PDO::FETCH_CLASS, "Mcosf\Testes\Professor" );
    
        if ( $registros != null and sizeof($registros) > 0 ) {
            $retorno = $registros[0];
        }
    }
    
    return $retorno;
}

function baixarImagem(int $matriculaProfessor) {

    $nomeImagem = NULL;

    $stmt = null;
    $registros = null;

    // conectar BD
    $con = conectarBD();
    
    // executar a query
    $stmt = $con->prepare("SELECT foto FROM professores WHERE matricula = :matriculaProfessor" );
    $stmt->bindParam(':matriculaProfessor', $matriculaProfessor);

    if ( $stmt->execute() ) {
        $registros = $stmt->fetch();

        if ( $registros != null and sizeof($registros) > 0 ) {
            $nomeImagem = 'downloads/' . $registros['foto'];


        }
    }

    return $nomeImagem;
}

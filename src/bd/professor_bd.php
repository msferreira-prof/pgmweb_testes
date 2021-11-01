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

        $nomeFoto = time(). '.jpg';

        if ( move_uploaded_file( $fotoProfessor['tmp_name'], $nomeFoto) ) {

            $tamanhoImagem = filesize($nomeFoto);
            $handle = fopen($nomeFinal, "r");
            $mysqlImg = addslashes(fread($handle, $tamanhoImg));
            fclose($handle);
            

        }
    }
    
    // conectar BD
    $con = conectarBD();

    // executar a query
    $stmt = $con->prepare("INSERT INTO professores (matricula, nome, fotoProfessor) VALUES (DEFAULT, :nomeProfessor, :mySqlImg)");
    $stmt->bindParam(':nomeProfessor', $nomeProfessor);
    $stmt->bindParam(':mySqlImg', $mySqlImg);

    try {
        $stmt->execute();
    } catch ( PDOException $e ) {
        echo 'Erro ao conectar o MySQL: ' . $e->getMessage();
        exit();
    }
    
    // recuperar o codigo gerado 
    $matriculaGerada = $con->lastInsertId();

    // liberar o objeto de execucao da query
    $stmt = null;

    // desconectar BD
    desconectarBD($con);

    // montar o objeto professor
    $objProfessor = new Professor();
    $objProfessor->setMatricula($matriculaGerada);
    $objProfessor->setNome($nomeProfessor);

    return $objProfessor;
}


// listar professor
function listar() {
    $stmt = null;
    $registros = null;

    // conectar BD
    $con = conectarBD();

    // listar professores
    $stmt = $con->prepare("SELECT matricula, nome FROM professores");
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

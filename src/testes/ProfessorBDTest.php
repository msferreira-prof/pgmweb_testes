<?php

require 'src/bd/bd.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

use Mcosf\Testes\Professor;

class ProfessorBDTest extends TestCase {

    public function testProfessorEncontrado() {
     
        // preparar o cenario / ARRANGE / GIVEN
        $nomeProfessor = 'Augusto Joana';
        $nomeProfessorLido = '';

        // conectar BD
        $con = conectarBD();

        // preparando a query
        $stmt = $con->prepare('SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor');
        $stmt->bindParam(':nomeProfessor', $nomeProfessor);

        // executar o codigo a ser testado / ACT / WHEN
        $stmt->execute();

        $count = $stmt->rowCount();

        // desconectar BD
        desconectarBD($con);
     
        if ($count > 0) {
            $stmt->setFetchMode( PDO::FETCH_CLASS, 'professor');
            $objProfessor = $stmt->fetch();
            $nomeProfessorLido = $objProfessor['nome'];
        }

        // verificar se o resultado eh o esperado / ASSERT / THEN
        $this->assertEquals($nomeProfessor, $nomeProfessorLido);

    }

    public function testProfessorNaoEncontrado() {
     
        // preparar o cenario / ARRANGE / GIVEN
        $nomeProfessor = 'Augusto Joana';
        $nomeProfessorLido = '';

        // conectar BD
        $con = conectarBD();

        // preparando a query
        $stmt = $con->prepare('SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor');
        $stmt->bindParam(':nomeProfessor', $nomeProfessor);

        // executar o codigo a ser testado / ACT / WHEN
        $stmt->execute();

        $count = $stmt->rowCount();

        // desconectar BD
        desconectarBD($con);

        // verificar se o resultado eh o esperado / ASSERT / THEN
        $this->assertNotEquals(0, $count);

    }

    public function testProfessorMatriculaEncontrada() {
     
        // preparar o cenario / ARRANGE / GIVEN
        $nomeProfessor = 'Einstein Jones';
        $matriculaEsperada = 2;
        $matriculaLida = -1;

        // conectar BD
        $con = conectarBD();

        // preparando a query
        $stmt = $con->prepare('SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor');
        $stmt->bindParam(':nomeProfessor', $nomeProfessor);

        // executar o codigo a ser testado / ACT / WHEN
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0 ) {
            $stmt->setFetchMode( PDO::FETCH_CLASS, 'professor' );
            $objProfessor = $stmt->fetch();
            $matriculaLida = intval($objProfessor['matricula']);
        }

        // desconectar BD
        desconectarBD($con);

        // verificar se o resultado eh o esperado / ASSERT / THEN
        $this->assertEquals($matriculaEsperada, $matriculaLida);

    }

    public function testProfessorMatriculaMaiorQue4() {
     
        // preparar o cenario / ARRANGE / GIVEN
        $nomeProfessor = 'Einstein Jones';
        $matriculaEsperada = 4;
        $matriculaLida = -1;

        // conectar BD
        $con = conectarBD();

        // preparando a query
        $stmt = $con->prepare('SELECT matricula, nome FROM professores WHERE nome = :nomeProfessor');
        $stmt->bindParam(':nomeProfessor', $nomeProfessor);

        // executar o codigo a ser testado / ACT / WHEN
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0 ) {
            $stmt->setFetchMode( PDO::FETCH_CLASS, 'professor' );
            $objProfessor = $stmt->fetch();
            $matriculaLida = intval($objProfessor['matricula']);
        }

        // desconectar BD
        desconectarBD($con);

        // verificar se o resultado eh o esperado / ASSERT / THEN
        $this->assertGreaterThan($matriculaEsperada, $matriculaLida);

    }
}
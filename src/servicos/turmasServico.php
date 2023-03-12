<?php

namespace Mcosf\Testes\Servicos;

use Mcosf\Testes\Turma;
use Mcosf\Testes\Professor;
use Mcosf\Testes\Aluno;

class TurmasServico {

    private $turmas;

    public function __construct() {
        $this->turmas = array();
    }

    public function getTurmas() {
        return $this->turmas;
    }

    public function addTurma( Turma $turma ) {
        array_push( $this->turmas, $turma );
    }

    public function getQtdTurmas() {
        return count($this->turmas);
    }

    public function getAlunos( string $codigoTurma ) : array {
        $alunos = array();

        foreach( $this->turmas as $turma ) {
            if ( $codigoTurma == $turma->getCodigo() ) {
                $alunos = $turma->getAlunos();
                break;
            }
        }

        return $alunos;
    } 

    public function getProfessor( string $codigoTurma ) {
        $professor = null;
        foreach( $this->turmas as $turma ) {
            if ( $codigoTurma == $turma->getCodigo() ) {
                $professor = $turma->getProfessor();
                break;
            }
        }

        return $professor;
    }

    public function getProfessoresComLetraM() {
        $professores = array();
        foreach( $this->turmas as $turma ) {
            $professor = $turma->getProfessor();
            $nomeProfessor = $professor->getNome();
            if ( $nomeProfessor == "M" ) {
                array_push( $professores, $professor );
            }
        }

        return $professores;
    }
}

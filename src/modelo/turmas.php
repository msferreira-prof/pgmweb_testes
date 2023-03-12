<?php

namespace Mcosf\Testes;

use Mcos\Testes\Turma;
use Mcosf\Testes\Professor;
use Mcosf\Testes\Aluno;

class Turmas {
    
    private $turmas;
    
    public function __construct(array $turmas = null) {
        if ( $turmas == NULL ) {
            $turmas = [];
        } else {
            $this->turmas = $turmas;
        }
    }

    public function getQtdTurmas() {
        return count($this->turmas);
    }

    public function getAlunos(string $codigoTurma) : array {
        $alunos = [];
        foreach( $this->turmas as $turma ) {
            if ( $codigoTurma == $turma->codigo ) {
                $alunos = $turma->getAlunos();
                break;
            }
        }
        
        return $this->$alunos;
    }

    public function getProfessor(string $codigoTurma) {
        $professor = null;
        foreach( $this->turmas as $turma ) {
            if ( $codigoTurma == $turma->codigo ) {
                $professor = $turma->getProfessor();
                break;
            }
        }
        
        return $this->$professor;
    }

    public function getProfessoresComLetraM() {
        $professores = [];
        foreach( $this->turmas as $turma ) {
            $professor = $turma->getProfessor();
            $nomeProfessor = $professor->getNome();
            if ($professor->getNome() == "M" ) {
                array_push($professor);
            }
        }
        
        return $professores;
    }
}


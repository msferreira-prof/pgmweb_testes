<?php

namespace Mcosf\Testes;

use Mcosf\Testes\Professor;
use Mcosf\Testes\Aluno;

class Turma {
    private $codigo;
    private $serie;
    private $sala;
    private $horaInicial;
    private $horaFinal;
    private $professor;
    private $alunos;

    public function __construct() {
        $alunos = [];
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo( string $codigo ) {
        $this->codigo = $codigo;
    }
        
    public function getSerie() {
        return $this->serie;
    }
        
    public function getSala() {
        return $this->sala;
    }

    public function setSala( int $sala ) {
        $this->sala = $sala;
    }
    
    public function getHoraInicial() {
        return $this->horaInicial;
    }

    public function setHoraInicial( string $horaInicial ) {
        $this->serie = $horaInicial;
    }

    public function getHoraFinal() {
        return $this->horaFinal;
    }

    public function setHoraFinal( string $horaFinal ) {
        $this->horaFinal = $horaFinal;
    }

    public function getProfessor() {
        return $this->professor;
    }

    public function setProfessor( Professor $professor ) {
        $this->professor = $professor;
    } 

    public function getAlunos() : array {
        return $this->alunos;
    }

    public function setAlunos( array $alunos ) {
        $this->alunos = $alunos;
    }

    public function addAluno( Aluno $aluno ) {
        array_push($this->alunos, $aluno);
    }

    public function removeAluno( int $matriculaAluno ) {
        for( $i=0; $i < count($this->alunos); $i++ ) {
            $aluno = $this->alunos[$i];
            if ( $matriculaAluno == $aluno->getMatricula() ) {
                unset( $this->aluno[$i] );
            }
        }
    }

    public function removeAlunoV2( Aluno $aluno ) {
        $i = array_search( $aluno, $this->alunos );
        unset( $this->aluno[$i] );
    }

}
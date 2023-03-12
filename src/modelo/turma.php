<?php

namespace Mcosf\Testes;

use Mcosf\Testes\Professor;
use Mcosf\Testes\Aluno;

class Turma {
    private $codigo;
    private $serie;
    private $sala;
    private $hora_inicial;
    private $hora_final;
    private $professor;
    private $alunos;

    private function __construct() {
        $alunos = [];
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo( int $codigo ) {
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

    public function setHoraInicial( int $horaInicial ) {
        $this->serie = $horaInicial;
    }

    public function getHoraFinal() {
        return $this->horaFinal;
    }

    public function setHoraFinal( int $horaFinal ) {
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

    public function setAlunos( Aluno $aluno ) {
        $this->alunos[] = $aluno;
    }
}
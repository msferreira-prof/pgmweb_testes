<?php

namespace Mcosf\Testes;
class Professor {

    private $matricula;
    private $nome;
    private $nomeFoto;


    function __construct() {
    }

    public function getMatricula() : int {
        return $this->matricula;
    }

    public function getNome() : string {
        return $this->nome;
    }

    public function setMatricula(int $matricula) {
        $this->matricula = $matricula;
    }

    public function setNome(string $nome) {
        $this->nome = $nome;
    }

    public function getProfessorCompleto() : string {
        return $this->matricula . ' - ' . $this->nome;
    }


    public function getNomeFoto() {
        return $this->nomeFoto;
    }

    public function setNomeFoto(string $nomeFoto) {
        return $this->nomeFoto = $nomeFoto;
    }

}
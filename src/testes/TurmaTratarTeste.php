<?php

include "vendor/autoload.php";


use PHPUnit\Framework\TestCase;
use Mcos\Testes\Professor;
use Mcos\Testes\Turmas;
use Mcos\Testes\Aluno;

$turmas = new Turmas();

$professor = new Professor();
$professor->setMatricula(1);
$professor->setNome("Jose");

$turma = new Turma();
$turma->setProfessor($professor);

for ($i=0; $i<3; $i++) {
    $aluno = new Aluno();
    $aluno->setMatricula($i+1);
    $aluno->setNome('Aluno' . ($i+1));

    $turma->setAluno($aluno);
}

var_dump($turma);


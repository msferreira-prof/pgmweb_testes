<?php

use Mcosf\Testes\Professor;
use Mcosf\Testes\Aluno;
use Mcosf\Testes\Turma;
use Mcosf\Testes\Servicos\TurmasServico;

require '../modelo/professor.php';
require '../modelo/aluno.php';
require '../modelo/turma.php';
require '../servicos/turmasServico.php';

// criei o conjunto de turmas
$turmas = new TurmasServico();

// criar uma turma
$turma = new Turma();
$turma->setCodigo("T01");
$turma->setHoraInicial("18:00");
$turma->setHoraFinal("22:00");
$turma->setSala(405);

// criar professor
$professor = new Professor();
$professor->setMatricula(1);
$professor->setNome("Jose");

// atribuir o professor a turma
$turma->setProfessor( $professor );

// adicionar a turma ao conjunto de turmas
$turmas->addTurma( $turma );

var_dump($turma);
var_dump($turmas);

<?php
    
    require 'modelo/usuario.php';
    use Mcosf\Testes\Usuario;

    
    /* verifica se uma sessao esta criada, validando a entrada, caso contrario vai para o login */
    session_start();
    $sessaoValida = isset($_SESSION['idSessao']) ? $_SESSION['idSessao'] === session_id() : FALSE;

    if ( $sessaoValida != true ) {
        header('Location: login.php');
        exit();
    }

    // recupera o usuario logado, caso contrario vai para o login
    if ($_SESSION['usuarioLogado'] != NULL) {
        // nao se esqueca de desserializar o objeto
        $usuarioLogado = unserialize($_SESSION['usuarioLogado']);
        $nomeUsuarioLogado = $usuarioLogado->getNome();     

    } else {
        header('location: login.php');
        exit();

    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Exercícios PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- define e insere um favicon no documento HTML -->
    <link href="img/php.ico" rel="shortcut icon">

    <!-- versao gratuita do Font Awesome icons-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <!-- insira este conteudo aqui que representa o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google  icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="css/meu-estilo.css" rel="stylesheet">
</head>

<body>

    <!-- seu codigo comeca aqui -->

    <!-- container bootstrap -->
    <header class="container px-0">

        <nav class="navbar navbar-expand-lg navbar-light bg-light px-0">

            <!-- logo -->
            <div>
                <a class="navbar-brand mx-auto">
                    <img src="img/php_96.png">
                </a>

                <span class="usuario">Bem-vindo, <?=$nomeUsuarioLogado;?>!</span>
                
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar"
                aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Navegação Alternativa">
                Menu <span class="navbar-toggler-icon"></span>
            </button>

            <!-- menu -->
            <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
                <div class="navbar-nav">
                    <a href="#" class="nav-link">Início</a>
                    <a href="cadastrarProfessor_bs.php" class="nav-link">Cadastrar</a>
                    <a href="consultarProfessor_bs.php" class="nav-link">Consultar</a>
                    <a href="servicos/listarProfessor_servico.php" class="nav-link">Listar</a>
                    <a href="servicos/login_servico.php" class="nav-link">Sair</a>
                </div>
            </div>
        </nav>

        <div class="container text-center">
            <div class="jumbotron mt-5">
                <h1 class="display-4">Lista de Chamadas - Professores</h1>
            </div>
        </div>
    </header>

    <footer class="container text-center">
        <div class="row border-top border-primary bg-light">
            <div class="col font text-primary copyright">
                <p>&copy; Copyright Pmg Web</p>
            </div>
        </div>
    </footer>

    <!-- seu codigo termina aqui -->

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

</body>

</html>
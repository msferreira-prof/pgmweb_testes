<?php
    session_start();

    if ($_SESSION['usuarioLogado'] != NULL) {
       unset($_SESSION['usuarioLogado']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <!-- insira este conteudo aqui que representa o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link href="css/meu-estilo-login.css" rel="stylesheet">
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
            </div>

        </nav>

        <?php
            if ($_SESSION['mensagemRetorno'] != NULL) {
               $mensagem = $_SESSION['mensagemRetorno'];     
        ?>

        <div class="row">
                <!-- coluna (grid system) -->
                <div class="col">
                    <!-- bloco tipo "alerta", alerta backgroundcolor, alerta pode ser desfeito / papel = alerta -->
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <!-- ancora, classe="close" botao pode ser desfeito -->
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?=$mensagem?>
                    </div>
                </div>
        </div>

        <?php
                unset($_SESSION['mensagemRetorno']);
            }
        ?>

    </header>

    <main class="container m-2 w-75 mx-auto my-font-family">
    
        <div id="login">

            <div class="container">

                <div id="linha-login" class="row justify-content-center align-items-center">

                    <div id="coluna-login" class="col-md-6">

                        <div id="caixa-login" class="col-md-12">

                            <form name="login" action="servicos/login_servico.php" method="post" class="my-label-color-purple">

                                <h3 class="text-center my-h3">Login</h3>

                                <div class="form-group">
                                    <label for="idUsuario" class="my-label-color-purple">Usuário</label>
                                    <input class="form-control" type="text" id="idUsuario" name="usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="idSenha" class="my-label-color-purple">Senha</label>
                                    <input class="form-control" type="password" id="idSenha" name="senha" required>
                                </div>

                                <div class="form-row form-group">

                                    <label for="idLembrar" class="col-6 justify-content-start my-label-color-purple">
                                        <span>Lembre de mim</span> 
                                        <span><input id="idLembrar" name="lembrar" type="checkbox"></span>
                                    </label>
                                    <a href="#" class="col-6 text-right my-label-color-purple">Esqueceu a
                                        senha?</a>
                                </div>

                                <input type="submit" class="btn btn-info btn-block" value="Entrar">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="container text-center">
        <div class="row border-top border-primary bg-light">
            <div class="col font text-primary copyright">
                <p>&copy; Copyright Pmg Web</p>
            </div>
        </div>
    </footer>

    <!-- seu codigo termina aqui -->

    <!-- Bootstrap -->
    <!-- insira este conteudo do Bootstrap aqui, antes do fechamento do "body" -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

</body>

</html>
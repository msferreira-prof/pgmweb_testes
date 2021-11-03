<?php
    /* insere apenas uma vez os arquivos com as funcoes e classes utilizadas */
    require 'modelo/professor.php';
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
    if ($_SESSION['usuarioLogado'] == NULL) {
        header('location: login.php');
    } else {
        // nao se esqueca de desserializar o objeto
        $usuarioLogado = unserialize($_SESSION['usuarioLogado']);
        $nomeUsuarioLogado = $usuarioLogado->getNome();     
    }

    // recupera lista de professores
    $professores = $_SESSION['professores'];
?>
<!-- inicio do codigo HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Exercícios PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="img/php.ico" rel="shortcut icon">

    <!-- versao gratuita do Font Awesome icons-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link href="css/meu-estilo.css" rel="stylesheet">

</head>

<body>

    <!-- seu codigo comeca aqui -->

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
                    <a href="home.php" class="nav-link">Início</a>
                    <a href="cadastrarProfessor_bs.php" class="nav-link">Cadastrar</a>
                    <a href="consultarProfessor_bs.php" class="nav-link">Consultar</a>
                    <a href="servicos/listarProfessor_servico.php" class="nav-link">Listar</a>
                    <a href="servicos/login_servico.php" class="nav-link">Sair</a>
                </div>
            </div>
        </nav>

    </header>

    <main class="container m-2 w-75 mx-auto my-font-family">

        <div class="row">
            <div class="col text-center m-0">
                <h2 class="mt-2 mb-0 my-h2">Professor - Listar</h2>
            </div>
        </div>

        <div class="table-responsive">
            
            <table class="table
                          table-borderless
                          text-center
                          my-table-hover
                          my-table-td-first-child
                          my-table-border-bottom
                          my-table-th">

                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Professor</th>
                        <th>Foto</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- inicio bloco PHP com HTML -->
                    <?php
                       if ( $professores != null ) {
                            
                            foreach($professores as $objProfessor) {  
                                $matricula = $objProfessor->getMatricula();
                                $nome = $objProfessor->getNome();
                                $imagem = $objProfessor->getNomeFoto() != NULL ?                                 
                                            'uploads/' . $objProfessor->getNomeFoto() :
                                            '#';
                    ?>

                    <tr>
                        <td>
                            <?=$objProfessor->getMatricula();?>
                        </td>
                        <td>
                            <?=$nome;?>
                        </td> 
                        <td>
                            <button type="button" class="btn" role="button" data-target="#modalProfessor"
                                    data-toggle="modal"  data-nome="Prof(a) <?=$nome;?>" data-url="<?=$imagem;?>">
                                <i class="fas fa-portrait"></i>
                            </button>
                        </td>                        
                    </tr>

                    <?php
                            }

                            unset($_SESSION['professores']);

                        } else {
                    ?>
                    
                    <tr>
                        <td colspan="2">
                            Não existe professores cadastrados
                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                </tbody>

                <!-- fim bloco PHP com HTML -->

            </table>
        
        </div>

    </main>

    <footer class="container text-center">
        <div class="row border-top border-primary bg-light">
            <div class="col font text-primary copyright">
                <p>&copy; Copyright Pmg Web</p>
            </div>
        </div>
    </footer>


    <!-- Modais -->
    <div class="modal fade" id="modalProfessor" role="dialog" aria-labelledby="<?=$nome?>" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="tituloModal" class="modal-title meu-h5-font-size"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body text-center">
                    <img src="" id="foto" height="300" width="300" class="img-fluid img-thumbnail" alt="Foto não encontrada">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                </div>

            </div>

        </div>
    
    </div>
    <!-- seu codigo termina aqui -->

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalProfessor').on('show.bs.modal', function(event) {
                var imagem = $(event.relatedTarget).data('url');
                var nomeProfessor = $(event.relatedTarget).data('nome');
                $("#tituloModal").text(nomeProfessor);
                $("#foto").attr('src', imagem);
            });
        });
    </script>


</body>

</html>
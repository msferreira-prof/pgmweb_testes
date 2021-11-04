<?php
/* insere apenas uma vez os arquivos com as funcoes e classes utilizadas */
require_once '../modelo/professor.php';
require_once '../bd/professor_bd.php';

/* verifica se uma sessao esta criada, validando a entrada, caso contrario vai para o login */
session_start();
$sessaoValida = isset($_SESSION['idSessao']) ? $_SESSION['idSessao'] === session_id() : FALSE;

if ( $sessaoValida != true ) {
   header('Location: ../login.php');
   exit();
}


/* receber nome do professor do formulario HTML */
$nomeProfessor = $_POST['nomeProfessor'];

/* valida se upload da foto foi com sucesso */
if ( $_FILES['fotoProfessor']['error'] == UPLOAD_ERR_OK ) {
    
    $fotoProfessor = $_FILES['fotoProfessor'];

} else {
    $_SESSION['mensagemRetorno'] = 'Tamanho da imagem informada excede o limite permitido';
    
    /* retorna para a pagina de cadastro do professor */
    header('Location: ../cadastrarProfessor_bs.php');
    
    return;
}

// valida tipo de imagem do upload
// sao apenas aceitas imagens do tipo JPEG, PNG e JPG
$tiposImagem = ['image/jpeg', 'image/png', 'image/jpg'];
if ( in_array($fotoProfessor['type'], $tiposImagem, false ) == FALSE ) {
    
    $_SESSION['mensagemRetorno'] = 
            'Formato de imagem incorreto. Formatos permitidos: jpg, png e jpeg.';
    
    /* retorna para a pagina de cadastro do professor */
    header('Location: ../cadastrarProfessor_bs.php');
    
    return;
}


/* validacao pode ser feita no PHP ou no Javascript */
if ( strlen($nomeProfessor) < 15 ) {
    $_SESSION['mensagemRetorno'] = 'Nome de professor informado menor que 15 caracteres';
    
    /* retorna para a pagina de cadastro do professor */
    header('location: ../cadastrarProfessor_bs.php');
    
    return;
}

/* 
    validacao deve ser feita no PHP 
    exemplo retornando verdadeiro ou falso
*/
// if ( validarNomeDuplicado($nomeProfessor) == true ) {
//     $_SESSION['mensagemRetorno'] = 'Nome de professor já cadastrado';
    
//     /* retorna para a pagina de cadastro do professor */
//     header('location: ../cadastrarProfessor_bs.php');
    
//     return;
// }

/* 
    validacao deve ser feita no PHP 
    exemplo retornando um objeto
*/
$objProfessor = validarNomeDuplicadoV2($nomeProfessor);
if ( $objProfessor != null ) {
    $_SESSION['mensagemRetorno'] = 
           'Nome de professor já cadastrado. Código: ' . $objProfessor->getMatricula();
    
    /* retorna para a pagina de cadastro do professor */
    header('location: ../cadastrarProfessor_bs.php');
    
    return;
}




// inclusao
$objProfessor = incluir($nomeProfessor, $fotoProfessor);

if ($objProfessor != null) {
    $mensagemRetorno = "Professor '" . $objProfessor->getNome() . 
                       ' inserido com sucesso. Código: ' .
                       $objProfessor->getMatricula();
} else {
    $mensagemRetorno = "Falha ao inserir o professor $nomeProfessor";
}

/* armazena o valor da mensagem de retorno na sessao */
$_SESSION['mensagemRetorno'] = $mensagemRetorno;

/* retorna para a pagina de cadastro do professor */
header('location: ../cadastrarProfessor_bs.php');


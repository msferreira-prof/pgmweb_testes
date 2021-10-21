<?php 

require '../modelo/usuario.php';

$usuario = new Usuario();
$usuario->setId(10);
$usuario->setNome('Maria Cristina Freitas');
$usuario->setEmail('mcfreitas@abc.com');
$usuario->setSenha('abd4x09b23');

// var_dump($usuario);
/* teste
    tamanho senha < 3               = Msg "Senha invalida"
    tamanho senha >= 3 e senha <= 7 = Msg "Senha curta"
    tamanho senha >= 8              = Msg "Senha valida"
*/

if ( strlen($usuario->getSenha()) >= 8 ) {
    echo 'Senha válida';

} elseif ( strlen($usuario->getSenha()) >= 3 && 
           strlen($usuario->getSenha()) <= 7 ) {
    echo 'Senha curta';

} else {
    echo 'Senha inválida';
}


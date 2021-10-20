<?php
/* 
    codigo-fonte originalmente apresentado no "Blog do Beraldo"
    em: http://rberaldo.com.br/como-gerar-logs-execucao-php/
*/
function logMsg($msg, $level = 'info', $file = 'main.log')
{
    /* 
        codigo-fonte atualizado para gerar o log em uma pasta criada no Root do servidor 
        DOCUMENT_ROOT
        Diretório raiz sob onde o script atual é executado, como definido no arquivos de configuração do servidor. 
        (vide manual do PHP - https://www.php.net/manual/pt_BR/reserved.variables.server.php)
        No Apache do Xampp, o root encontra-se em /xampp/htdocs
        Assim, será criada uma nova pasta: /xampp/htdocs/logs
    */
    $logFilePath = $_SERVER['DOCUMENT_ROOT']."/logs";
    if ( !file_exists($logFilePath) ) {

        // cria a pasta para registrar o log (estilo Unix)
        mkdir($logFilePath, 0777, true);
        
    }

    // gera um nome de arquivo com data 
    $logFileDate = $logFilePath.'/log_' . date('Ymd') . '.log';

    // variável que vai armazenar o nível do log (INFO, WARNING ou ERROR)
    $levelStr = '';
    // verifica o nível do log
    switch ($level) {
        case 'info':
            // nível de informação
            $levelStr = 'INFO';
            break;
        case 'warning':
            // nível de aviso
            $levelStr = 'WARNING';
            break;
        case 'error':
            // nível de erro
            $levelStr = 'ERROR';
            break;
    }
    
    // data atual
    $date = date('Y-m-d H:i:s');
    
    // formata a mensagem do log
    // 1o: data atual
    // 2o: nível da mensagem (INFO, WARNING ou ERROR)
    // 3o: a mensagem propriamente dita
    // 4o: uma quebra de linha
    $msg = sprintf("[%s] [%s]: %s%s", $date, $levelStr, $msg, PHP_EOL);
    
    // escreve o log no arquivo
    // é necessário usar FILE_APPEND para que a mensagem seja escrita no final do arquivo, preservando o conteúdo antigo do arquivo
    // file_put_contents($file, $msg, FILE_APPEND); // original
    file_put_contents($logFileDate, $msg . "\n", FILE_APPEND);

}

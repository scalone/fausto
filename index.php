<?php //namespace FatecFranca\ADS8N;

//use \FatecFranca\ADS8;

//echo "Criada página padrão do projeto";

// Exibe todos os erros
error_reporting(E_ALL);

require_once('./classes/Application.php');

// Iniciando a aplicação
$app = new Application('development');
$app->run();
?>
<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__."/../vendor/autoload.php";

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__."/../config/rotas.php";

if( !array_key_exists($caminho, $rotas) )
{
  http_response_code(404);
  exit();
}

session_start();

if( !isset($_SESSION['logado']) and $rotas[$caminho]['autorizado'] )
{
  header("Location: /login", true, 301);
}

$psr17Factory = new Psr17Factory();
$serverRequest = new ServerRequestCreator(
  $psr17Factory,
  $psr17Factory,
  $psr17Factory,
  $psr17Factory
);

$request = $serverRequest->fromGlobals();

$containers = require __DIR__."/../config/depedencias.php";

$classControlador = $rotas[$caminho]['class'];
/** @var Psr\Http\Server\RequestHandlerInterface $controlador */
$controlador = $containers->get($classControlador);
$resposta = $controlador->handle($request);

foreach( $resposta->getHeaders() as $nome => $valores )
{
  foreach( $valores as $valor )
  {
    header(sprintf("%s: %s", $nome, $valor), false);
  }
}

echo $resposta->getBody();
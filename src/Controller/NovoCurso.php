<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RederizarHtml;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NovoCurso implements RequestHandlerInterface
{

  use RederizarHtml;

  public function __construct()
  {
    //  ...
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    
    return new Response(200, [], $this->chamarHtml("/cursos/formulario-curso.php", [
      'titulo' => "Novo Curso"
    ]));

  }

}

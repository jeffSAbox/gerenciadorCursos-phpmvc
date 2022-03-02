<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RederizarHtml;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursos implements RequestHandlerInterface
{

  use RederizarHtml;

  private $repositorioDeCursos;

  public function __construct()
  {
    $entityManager = (new EntityManagerCreator())
      ->getEntityManager();
    $this->repositorioDeCursos = $entityManager
      ->getRepository(Curso::class);

  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    
    return new Response(200, [], $this->chamarHtml("/cursos/listar-cursos.php", [
      'cursos' => $this->repositorioDeCursos->findAll(),
      'titulo' => "Lista de Cursos"
    ]));

  }

}

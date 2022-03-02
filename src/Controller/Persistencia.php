<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{

  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {

    $this->entityManager = $entityManager;

  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {

    //  FILTRAR descricao
    $descricao = $request->getParsedBody()['descricao'];

    $id = filter_var($request->getQueryParams()['id'], 
    FILTER_VALIDATE_INT);

    $curso = new Curso();
    if( !is_null($id) and $id !== false ){
      $curso = $this->entityManager->find(Curso::class, $id);
    }
    else{
      $this->entityManager->persist($curso);
    }

    $curso->setDescricao($descricao);
    $curso->setNota(3);

    $this->entityManager->flush();

    return new Response(302, [
      'Location' => "/listar-cursos"
    ]);

  }

}

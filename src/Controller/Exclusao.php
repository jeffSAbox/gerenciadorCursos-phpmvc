<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface
{
    
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        
        $this->entityManager = $entityManager;

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        if( is_null($id) or $id === false ){

            return new Response(302, [
                'Location' => "/listar-cursos"
            ]);

        }

        $curso = $this->entityManager->getReference(Curso::class, $id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();

        return new Response(302, [
            'Location' => "/listar-cursos"
        ]);

    }

}

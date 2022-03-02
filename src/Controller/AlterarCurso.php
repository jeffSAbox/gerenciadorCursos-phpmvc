<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Helper\RederizarHtml;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AlterarCurso implements RequestHandlerInterface
{

    use RederizarHtml;

    private $entityManager;
    private $repositorioCurso;
    
    function __construct()
    {
        
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();

        $this->repositorioCurso = $this->entityManager
                ->getRepository(Curso::class);

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if( is_null($id) or $id === false ){

            return new Response(302, ['Location'=>'/listar-cursos']);

        }

        $curso = $this->repositorioCurso->find($id);

        return new Response(200, [], $this->chamarHtml("/cursos/formulario-curso.php", [
            'titulo' => 'Alterando curso ' . $curso->getDescricao(),
            'curso' => $curso
          ]));

    }

}

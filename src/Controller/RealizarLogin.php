<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{

    use FlashMessageTrait;

    private $usuarioRepositorio;

    public function __construct()
    {
        $entiyManager = (new EntityManagerCreator())->getEntityManager();
        $this->usuarioRepositorio = $entiyManager->getRepository(Usuario::class);
    }

    protected function verificarSenha(string $senha, Usuario $usuario): bool
    {

        if( !password_verify($senha, $usuario->getSenha()) )
        {
            return false;
        }

        return true;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        if( is_null($email) or $email === false )
        {
            $this->definirMessage("danger", "E-mail digitado é inválido!");
            return new Response(301, [
                'Location' => '/login'
            ]);
        }

        $senha = filter_var(
            $request->getParsedBody()['senha'],
            FILTER_SANITIZE_STRING
        );
        

        /** @var Usuario $usuario */
        $usuario = $this->usuarioRepositorio->findOneBy([
            "email" => $email
        ]);

        if( is_null($usuario) or !$this->verificarSenha($senha, $usuario) )
        {
            $this->definirMessage("danger", "E-mail ou Senha inválido!");
            return new Response(301, [
                'Location' => '/login'
            ]);
        }

        $_SESSION['logado'] = true;

        return new Response(301, [
            'Location' => '/listar-cursos'
        ]);

    }
    
}

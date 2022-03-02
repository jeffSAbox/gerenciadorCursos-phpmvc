<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RederizarHtml;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioLogin implements RequestHandlerInterface
{

    use RederizarHtml;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        return new Response(200, [], $this->chamarHtml("/login/formulario-login.php", [
            'titulo' => "Login"
        ]));
        
    }
    
}

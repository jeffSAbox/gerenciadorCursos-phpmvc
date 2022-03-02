<?php

namespace Alura\Cursos\Helper;

trait FlashMessageTrait
{

    public function definirMessage(string $tipo, string $mensagem)
    {
        $_SESSION['fm'] = [
            'tipo' => $tipo,
            'mensagem' => $mensagem
        ];
    }

}

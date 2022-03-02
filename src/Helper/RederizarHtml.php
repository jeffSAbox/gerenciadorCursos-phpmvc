<?php

namespace Alura\Cursos\Helper;

trait RederizarHtml
{

    protected function chamarHtml(string $caminho, array $variavies): string
    {

        extract($variavies);
        ob_start();
        require __DIR__."/../../view" . $caminho;
        $html = ob_get_clean();

        return $html;


    }
    
}

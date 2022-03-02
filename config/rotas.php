<?php

return array(
  //  area de acesso autorizado
  "/listar-cursos"=>[
    'class' => Alura\Cursos\Controller\ListarCursos::class,
    'autorizado' => true
  ],
  "/novo-curso"=>[
    'class' => Alura\Cursos\Controller\NovoCurso::class,
    'autorizado' => true
  ],
  "/salvar-curso"=>[
    'class' => Alura\Cursos\Controller\Persistencia::class,
    'autorizado' => true
  ],
  "/exclusao"=>[
    'class' => \Alura\Cursos\Controller\Exclusao::class,
    'autoriado' => true
  ],
  "/alterar-curso"=>[
    'class' => \Alura\Cursos\Controller\AlterarCUrso::class,
    'autorizado' => true
  ],
  "/logout"=>[
    'class' => \Alura\Cursos\Controller\Deslogar::class,
    'autorizado' => true
  ],
  "/listar-cursos-json"=>[
    'class' => \Alura\Cursos\Controller\BuscarCursosJson::class,
    'autorizado' => true
  ],

  //  area login
  "/login"=>[
    'class' => \Alura\Cursos\Controller\FormularioLogin::class,
    'autorizado' => false
  ],
  "/realizar-login"=>[
    'class' => \Alura\Cursos\Controller\RealizarLogin::class,
    'autorizado' => false
  ]
);

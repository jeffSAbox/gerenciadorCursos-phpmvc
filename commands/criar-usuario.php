<?php

require __DIR__."/../vendor/autoload.php";

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

$usuario = new Usuario();
$entityManager = (new EntityManagerCreator())->getEntityManager();

$email = $argv[1];
$senha = $argv[2];

$senha_hash = password_hash($senha, PASSWORD_ARGON2I);

$usuario->setEmail($email);
$usuario->setSenha($senha_hash);

$entityManager->persist($usuario);
$entityManager->flush();

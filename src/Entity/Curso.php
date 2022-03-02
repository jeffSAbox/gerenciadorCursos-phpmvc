<?php

namespace Alura\Cursos\Entity;

/**
 * @Entity
 * @Table(name="cursos")
 */
class Curso implements \JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $descricao;

    /**
     * @Column(type="integer", options={"default":5})
     */
    private $nota;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getNota(): int
    {
        return $this->nota;
    }

    public function setNota(int $nota): void
    {
        $this->nota = $nota;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getDescricao(),
            'nota' => $this->getNota()
        ];
    }
}

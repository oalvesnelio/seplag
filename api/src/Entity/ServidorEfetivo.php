<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity]
#[ApiResource()]
class ServidorEfetivo
{
    #[ORM\Id, ORM\OneToOne(targetEntity: Pessoa::class)]
    #[ORM\JoinColumn(name: 'pes_id', referencedColumnName: 'pes_id')]
    private Pessoa $pessoa;

    #[ORM\Column(name: 'se_matricula', type: Types::STRING, length: 20)]
    private string $matricula;

    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }
}

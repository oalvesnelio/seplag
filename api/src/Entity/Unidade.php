<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity]
#[ApiResource()]
class Unidade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'unid_id', type: Types::INTEGER)]
    private ?int $id;

    #[ORM\Column(name: 'unid_nome', length: 200, type: Types::STRING)]
    private string $nome;

    #[ORM\Column(name: 'unid_sigla', length: 20, type: Types::STRING)]
    private string $sigla;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity]
#[ApiResource()]
class Cidade
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'cid_id', type: Types::INTEGER)]
    private ?int $id;

    #[ORM\Column(name: 'cid_nome', length: 200, type: Types::STRING)]
    private string $nome;

    #[ORM\Column(name: 'cid_uf', length: 2, type: Types::STRING)]
    private string $uf;

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

    public function getUf(): string
    {
        return $this->uf;
    }

    public function setUf(string $uf): self
    {
        $this->uf = $uf;

        return $this;
    }
}

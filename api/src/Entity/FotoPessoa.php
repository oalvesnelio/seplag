<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity()]
#[ApiResource()]
class FotoPessoa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'fp_id', type: Types::INTEGER)]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Pessoa::class)]
    #[ORM\JoinColumn(name: 'pes_id', referencedColumnName: 'pes_id')]
    private Pessoa $pessoa;

    #[ORM\Column(name: 'fp_data', type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $data;

    #[ORM\Column(name: 'fp_bucket', length: 50)]
    private string $bucket;

    #[ORM\Column(name: 'fp_hash', length: 50)]
    private string $hash;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    public function getData(): string
    {
        return $this->data->format('d/m/Y');
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getBucket(): string
    {
        return $this->bucket;
    }

    public function setBucket(string $bucket): self
    {
        $this->bucket = $bucket;

        return $this;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }
}

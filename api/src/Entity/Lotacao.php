<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ApiResource]
class Lotacao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'lot_id', type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Pessoa::class)]
    #[ORM\JoinColumn(name: 'pes_id', referencedColumnName: 'pes_id')]
    private Pessoa $pessoa;

    #[ORM\ManyToOne(targetEntity: Unidade::class)]
    #[ORM\JoinColumn(name: 'unid_id', referencedColumnName: 'unid_id')]
    private Unidade $unidade;

    #[ORM\Column(name: 'lot_data_lotacao', type: Types::DATE_MUTABLE, nullable: false)]
    private \DateTimeInterface $dataLotacao;

    #[ORM\Column(name: 'lot_data_remocao', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataRemocao = null;

    #[ORM\Column(name: 'lot_portaria', length: 100)]
    private string $portaria;

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

    public function getUnidade(): Unidade
    {
        return $this->unidade;
    }

    public function setUnidade(Unidade $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function getDataLotacao(): \DateTimeInterface
    {
        return $this->dataLotacao;
    }

    public function setDataLotacao(\DateTimeInterface $dataLotacao): self
    {
        $this->dataLotacao = $dataLotacao;

        return $this;
    }

    public function getDataRemocao(): \DateTimeInterface
    {
        return $this->dataRemocao;
    }

    public function setDataRemocao(\DateTimeInterface $dataRemocao): self
    {
        $this->dataRemocao = $dataRemocao;

        return $this;
    }

    public function getPortaria(): string
    {
        return $this->portaria;
    }

    public function setPortaria(string $portaria): self
    {
        $this->portaria = $portaria;

        return $this;
    }
}

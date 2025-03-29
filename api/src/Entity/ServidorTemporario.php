<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity]
#[ApiResource()]
class ServidorTemporario
{
    #[ORM\Id, ORM\OneToOne(targetEntity: Pessoa::class)]
    #[ORM\JoinColumn(name: 'pes_id', referencedColumnName: 'pes_id')]
    private Pessoa $pessoa;

    #[ORM\Column(name: 'st_data_admissao', type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $dataAdmissao;

    #[ORM\Column(name: 'st_data_demissao', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataDemissao = null;

    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    public function getDataAdmissao(): \DateTimeInterface
    {
        return $this->dataAdmissao;
    }

    public function setDataAdmissao(\DateTimeInterface $dataAdmissao)
    {
        $this->dataAdmissao = $dataAdmissao;

        return $this;
    }

    public function getDataDemissao(): ?\DateTimeInterface
    {
        return $this->dataDemissao;
    }

    public function setDataDemissao(?\DateTimeInterface $dataDemissao)
    {
        $this->dataDemissao = $dataDemissao;

        return $this;
    }
}

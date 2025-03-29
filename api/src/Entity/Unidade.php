<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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

    #[ORM\ManyToMany(
        targetEntity: Endereco::class,
        inversedBy: 'unidades',
        cascade: ['persist', 'remove']
    )]
    #[ORM\JoinTable(name: 'unidade_endereco')]
    #[ORM\JoinColumn(
        name: 'unid_id',
        referencedColumnName: 'unid_id'
    )]
    #[ORM\InverseJoinColumn(
        name: 'end_id',
        referencedColumnName: 'end_id',
        onDelete: 'CASCADE'
    )]
    private ?Collection $enderecos = null;

    public function __construct()
    {
        $this->prepareEnderecos();
    }

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

    /**
     * @return Collection<int, Endereco>
     */
    public function getEnderecos(): Collection
    {
        $this->prepareEnderecos();

        return $this->enderecos;
    }

    public function addEndereco(Endereco $endereco): self
    {
        if (!$this->enderecos->contains($endereco)) {
            $this->enderecos->add($endereco);
        }

        return $this;
    }

    public function removeEndereco(Endereco $endereco): self
    {
        $this->enderecos->removeElement($endereco);

        return $this;
    }

    private function prepareEnderecos(): void
    {
        if (null === $this->enderecos) {
            $this->enderecos = new ArrayCollection();
        }
        if (is_array($this->enderecos)) {
            $this->enderecos = new ArrayCollection($this->enderecos);
        }
    }
}

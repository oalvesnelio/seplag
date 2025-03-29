<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ApiResource(
    normalizationContext: ["groups" => [self::GROUP_READ]],
    denormalizationContext: ["groups" => [self::GROUP_WRITE]],
)]
class Pessoa
{
    private const GROUP_READ = 'pessoa:read';
    private const GROUP_WRITE = 'pessoa:write';

    private const GROUPS = [
        self::GROUP_READ,
        self::GROUP_WRITE,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'pes_id', type: Types::INTEGER)]
    #[Groups("pessoa:read")]
    private ?int $id;

    #[ORM\Column(name: 'pes_nome', length: 200, type: Types::STRING)]
    #[Groups(self::GROUPS)]
    private string $nome;

    #[ORM\Column(name: 'pes_data_nascimento', type: Types::DATE_MUTABLE)]
    #[Groups(self::GROUPS)]
    private \DateTimeInterface $dataNascimento;

    #[ORM\Column(name: 'pes_sexo', length: 9, type: Types::STRING)]
    #[Groups(self::GROUPS)]
    private string $sexo;

    #[ORM\Column(name: 'pes_mae', length: 200, type: Types::STRING, nullable: true)]
    #[Groups(self::GROUPS)]
    private string $mae;

    #[ORM\Column(name: 'pes_pai', length: 200, type: Types::STRING, nullable: true)]
    #[Groups(self::GROUPS)]
    private string $pai;

    #[ORM\ManyToMany(
        targetEntity: Endereco::class,
        inversedBy: 'pessoas',
        cascade: ['persist', 'remove']
    )]
    #[ORM\JoinTable(name: 'pessoa_endereco')]
    #[ORM\JoinColumn(
        name: 'pes_id',
        referencedColumnName: 'pes_id'
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

    public function getDataNascimento(): string
    {
        return $this->dataNascimento->format('d/m/Y');
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getMae(): string
    {
        return $this->mae;
    }

    public function setMae(string $mae): self
    {
        $this->mae = $mae;

        return $this;
    }

    public function getPai(): string
    {
        return $this->pai;
    }

    public function setPai(string $pai): self
    {
        $this->pai = $pai;

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

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FuncionariosRepository")
 */
class Funcionarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $tipo;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Salarios", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $salario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Documentos", mappedBy="funcionario")
     */
    private $imagem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretarias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secretaria;

    public function __construct()
    {
        $this->imagem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSalario(): ?Salarios
    {
        return $this->salario;
    }

    public function setSalario(Salarios $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    /**
     * @return Collection|Documentos[]
     */
    public function getImagem(): Collection
    {
        return $this->imagem;
    }

    public function addImagem(Documentos $imagem): self
    {
        if (!$this->imagem->contains($imagem)) {
            $this->imagem[] = $imagem;
            $imagem->setImagem($this);
        }

        return $this;
    }

    public function removeImagem(Documentos $imagem): self
    {
        if ($this->imagem->contains($imagem)) {
            $this->imagem->removeElement($imagem);
            // set the owning side to null (unless already changed)
            if ($imagem->getImagem() === $this) {
                $imagem->setImagem(null);
            }
        }

        return $this;
    }

    public function getSecretaria(): ?Secretarias
    {
        return $this->secretaria;
    }

    public function setSecretaria(?Secretarias $secretaria): self
    {
        $this->secretaria = $secretaria;

        return $this;
    }
    public function __toString() {
        return $this->getNome();
    }
}

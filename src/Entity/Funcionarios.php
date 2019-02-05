<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


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
     * @var \DateTime
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $data_admissao;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $data_exoneracao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Documentos", mappedBy="funcionario", cascade={"persist", "remove"})
     */
    private $imagem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretarias", cascade={"persist"})
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
    public function getDataAdmissao()
    {
        return $this->data_admissao;
    }
    public function setDataAdmissao($data_admissao)
    {
        $this->data_admissao = $data_admissao;
        return $this;
    }
    public function getDataExoneracao()
    {
        return $this->data_exoneracao;
    }
    public function setDataExoneracao($data_exoneracao)
    {
        $this->data_exoneracao = $data_exoneracao;
        return $this;
    }
    public function __toString() {
        return $this->getNome();
    }
}

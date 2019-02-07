<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalariosRepository")
 */
class Salarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $salbase;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gratificacao;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $desconto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalbase(): ?float
    {
        return $this->salbase;
    }

    public function setSalbase(float $salbase): self
    {
        $this->salbase = $salbase;

        return $this;
    }

    public function getGratificacao(): ?float
    {
        return $this->gratificacao;
    }

    public function setGratificacao(?float $gratificacao): self
    {
        $this->gratificacao = $gratificacao;

        return $this;
    }

    public function getDesconto(): ?float
    {
        return $this->desconto;
    }

    public function setDesconto(?float $desconto): self
    {
        $this->desconto = $desconto;

        return $this;
    }
    
    public function getPagamento()
    {
        $remuneracao = $this->getSalbase();
        $gratificacao = $this->getGratificacao();
        $desconto = $this->getDesconto();
        return ($remuneracao + $gratificacao) - $desconto;
    }
    
}

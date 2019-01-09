<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentosRepository")
 */
class Documentos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionarios", cascade={"persist"})
     */
    private $imagem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }
}

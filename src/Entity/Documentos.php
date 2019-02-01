<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     *
     * @var string
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={"application/pdf", "image/png", "image/jpeg"})
     */
    private $imagem;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionarios", inversedBy="imagem")
     */
    private $funcionario;

     /**
     * Get the value of funcionario
     */ 
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set the value of funcionario
     *
     * @return  self
     */ 
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }
    

    /**
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }
}

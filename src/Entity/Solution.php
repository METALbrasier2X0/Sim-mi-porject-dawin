<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolutionRepository")
 */
class Solution
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
    private $libelle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Question", inversedBy="idSolution", cascade={"persist", "remove"})
     */
    private $id_question;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIdQuestion(): ?Question
    {
        return $this->id_question;
    }

    public function setIdQuestion(?Question $id_question): self
    {
        $this->id_question = $id_question;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->url_image;
    }

    public function setUrlImage(?string $url_image): self
    {
        $this->url_image = $url_image;

        return $this;
    }
}

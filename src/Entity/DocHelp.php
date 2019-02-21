<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocHelpRepository")
 */
class DocHelp
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url_doc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrlDoc(): ?string
    {
        return $this->url_doc;
    }

    public function setUrlDoc(string $url_doc): self
    {
        $this->url_doc = $url_doc;

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
}

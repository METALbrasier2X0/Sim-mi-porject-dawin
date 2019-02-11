<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeRepository")
 */
class Etape
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="id_Etape")
     */
    private $Questions_list;

    public function __construct()
    {
        $this->Questions_list = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestionsList(): Collection
    {
        return $this->Questions_list;
    }

    public function addQuestionsList(Question $questionsList): self
    {
        if (!$this->Questions_list->contains($questionsList)) {
            $this->Questions_list[] = $questionsList;
            $questionsList->setIdEtape($this);
        }

        return $this;
    }

    public function removeQuestionsList(Question $questionsList): self
    {
        if ($this->Questions_list->contains($questionsList)) {
            $this->Questions_list->removeElement($questionsList);
            // set the owning side to null (unless already changed)
            if ($questionsList->getIdEtape() === $this) {
                $questionsList->setIdEtape(null);
            }
        }

        return $this;
    }
}

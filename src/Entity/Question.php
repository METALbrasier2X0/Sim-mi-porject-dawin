<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
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
    private $text_reponse;

    /**
     * @ORM\Column(type="integer")
     */
    private $satisfactionC;

    /**
     * @ORM\Column(type="integer")
     */
    private $reputationE;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $reputationP;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etape", inversedBy="Questions_list")
     */
    private $id_Etape;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reponse", mappedBy="id_question")
     */
    private $ResponseList;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Solution", mappedBy="id_question", cascade={"persist", "remove"})
     */
    private $idSolution;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_image_reponse;


    public function __construct()
    {
        $this->ResponseList = new ArrayCollection();
        $this->documents = new ArrayCollection();
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

    public function getTextReponse(): ?string
    {
        return $this->text_reponse;
    }

    public function setTextReponse(string $text_reponse): self
    {
        $this->text_reponse = $text_reponse;

        return $this;
    }

    public function getSatisfactionC(): ?int
    {
        return $this->satisfactionC;
    }

    public function setSatisfactionC(int $satisfactionC): self
    {
        $this->satisfactionC = $satisfactionC;

        return $this;
    }

    public function getReputationE(): ?int
    {
        return $this->reputationE;
    }

    public function setReputationE(int $reputationE): self
    {
        $this->reputationE = $reputationE;

        return $this;
    }

    public function getReputationP(): ?int
    {
        return $this->reputationP;
    }

    public function setReputationP(int $reputationP): self
    {
        $this->reputationP = $reputationP;

        return $this;
    }

    public function getIdEtape(): ?Etape
    {
        return $this->id_Etape;
    }

    public function setIdEtape(?Etape $id_Etape): self
    {
        $this->id_Etape = $id_Etape;

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getResponseList(): Collection
    {
        return $this->ResponseList;
    }

    public function addResponseList(Reponse $responseList): self
    {
        if (!$this->ResponseList->contains($responseList)) {
            $this->ResponseList[] = $responseList;
            $responseList->setIdQuestion($this);
        }

        return $this;
    }

    public function removeResponseList(Reponse $responseList): self
    {
        if ($this->ResponseList->contains($responseList)) {
            $this->ResponseList->removeElement($responseList);
            // set the owning side to null (unless already changed)
            if ($responseList->getIdQuestion() === $this) {
                $responseList->setIdQuestion(null);
            }
        }

        return $this;
    }

    public function getIdSolution(): ?Solution
    {
        return $this->idSolution;
    }

    public function setIdSolution(?Solution $idSolution): self
    {
        $this->idSolution = $idSolution;

        // set (or unset) the owning side of the relation if necessary
        $newId_question = $idSolution === null ? null : $this;
        if ($newId_question !== $idSolution->getIdQuestion()) {
            $idSolution->setIdQuestion($newId_question);
        }

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

    public function getUrlImageReponse(): ?string
    {
        return $this->url_image_reponse;
    }

    public function setUrlImageReponse(?string $url_image_reponse): self
    {
        $this->url_image_reponse = $url_image_reponse;

        return $this;
    }

}

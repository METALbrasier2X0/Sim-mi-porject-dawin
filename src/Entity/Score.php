<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $satisfactionC;

    /**
     * @ORM\Column(type="integer")
     */
    private $reputationP;

    /**
     * @ORM\Column(type="integer")
     */
    private $reputationE;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_partie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="listScore")
     */
    private $isUser;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReputationP(): ?int
    {
        return $this->reputationP;
    }

    public function setReputationP(int $reputationP): self
    {
        $this->reputationP = $reputationP;

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

    public function getCreationPartie(): ?\DateTimeInterface
    {
        return $this->creation_partie;
    }

    public function setCreationPartie(\DateTimeInterface $creation_partie): self
    {
        $this->creation_partie = $creation_partie;

        return $this;
    }

    public function getIsUser(): ?User
    {
        return $this->isUser;
    }

    public function setIsUser(?User $isUser): self
    {
        $this->isUser = $isUser;

        return $this;
    }
}

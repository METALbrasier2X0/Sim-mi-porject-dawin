<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Score", mappedBy="isUser")
     */
    private $listScore;

    public function __construct()
    {
        $this->listScore = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): ?int
    {
        return $this->roles;
    }

    public function setRoles(?int $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getListScore(): Collection
    {
        return $this->listScore;
    }

    public function addListScore(Score $listScore): self
    {
        if (!$this->listScore->contains($listScore)) {
            $this->listScore[] = $listScore;
            $listScore->setIsUser($this);
        }

        return $this;
    }

    public function removeListScore(Score $listScore): self
    {
        if ($this->listScore->contains($listScore)) {
            $this->listScore->removeElement($listScore);
            // set the owning side to null (unless already changed)
            if ($listScore->getIsUser() === $this) {
                $listScore->setIsUser(null);
            }
        }

        return $this;
    }
}

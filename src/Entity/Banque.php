<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BanqueRepository;

use App\Entity\Traits\UserCreatedTrait;
use Doctrine\Common\Collections\Collection;
use App\Entity\Traits\StateTimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BanqueRepository")
 * @UniqueEntity ("name", repositoryMethod = "testUniqueEntityNameBank", message = "Ce nom est  déja utilisé ")
 */
class Banque
{
    use UserCreatedTrait;
    use StateTimestampableTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     * @Assert\NotNull(message="Veuillez renseigner le nom du banque")
     * @Assert\NotBlank(message="nom vide")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="banque")
     */
    private $comptes;



    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        if (empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
        if (empty($this->updatedAt)) {
            $this->updatedAt = new \DateTime();
        }
        if (empty($this->status)) {
            $this->status = true;
        }
        if (empty($this->isActive)) {
            $this->isActive = true;
        }
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

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setBanque($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getBanque() === $this) {
                $compte->setBanque(null);
            }
        }

        return $this;
    }
}

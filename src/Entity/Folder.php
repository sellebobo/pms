<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FolderRepository;
use Doctrine\Common\Collections\Collection;
use App\Entity\Traits\StateTimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=FolderRepository::class)
 */
class Folder
{

    use StateTimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="folder")
     */
    private $comptes;


    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="folder", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="folder", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $employe;


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
            $compte->setFolder($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getFolder() === $this) {
                $compte->setFolder(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getEmploye(): ?User
    {
        return $this->employe;
    }

    public function setEmploye(?User $employe): self
    {
        $this->employe = $employe;

        return $this;
    }
}

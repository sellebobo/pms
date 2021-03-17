<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\UserCreatedTrait;
use App\Entity\Traits\StateTimestampableTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 * @UniqueEntity (fields={"numCpte"}, repositoryMethod = "testUniqueEntityNumCpte"
 *, message = "cet  numéro de compte existe déja ")
 */
class Compte
{
    use UserCreatedTrait;
    use StateTimestampableTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"comptes:read","folder:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull(message="Veuillez renseigner le numéro du compte")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     * @Groups({"comptes:read","comptes:post","folder:read"})
     */
    private $numCpte;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"comptes:read","comptes:post","folder:read"})
     */
    private $type;

    /**
     * @ORM\Column(type="bigint",nullable=true)
     * @Groups({"comptes:read","comptes:post","folder:read"})
     */
    private $solde;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @Groups({"comptes:read","comptes:post"})
     */
    private $openingFees;

    /**
     * @ORM\ManyToOne(targetEntity=Banque::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $banque;

    /**
     * @ORM\ManyToOne(targetEntity=Folder::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $folder;


    public function __construct()
    {
       
        $this->openingFees = 0;
        
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

    public function getNumCpte(): ?string
    {
        return $this->numCpte;
    }

    public function setNumCpte(string $numCpte): self
    {
        $this->numCpte = $numCpte;

        return $this;
    }


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getOpeningFees(): ?int
    {
        return $this->openingFees;
    }

    public function setOpeningFees(int $openingFees): self
    {
        $this->openingFees = $openingFees;

        return $this;
    }

    public function getBanque(): ?Banque
    {
        return $this->banque;
    }

    public function setBanque(?Banque $banque): self
    {
        $this->banque = $banque;

        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }
}

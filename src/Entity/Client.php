<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\PersonTrait;
use App\Repository\ClientRepository;
use App\Entity\Traits\UserCreatedTrait;
use App\Entity\Traits\StateTimestampableTrait;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    use StateTimestampableTrait;
    use PersonTrait;
    use UserCreatedTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Community::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $community;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appreciation;

    /**
     * @ORM\OneToOne(targetEntity=Folder::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private $folder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isNewClient;

    public function __construct()
    {
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

    public function getCommunity(): ?Community
    {
        return $this->community;
    }

    public function setCommunity(?Community $community): self
    {
        $this->community = $community;

        return $this;
    }

    public function getAppreciation(): ?string
    {
        return $this->appreciation;
    }

    public function setAppreciation(?string $appreciation): self
    {
        $this->appreciation = $appreciation;

        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(Folder $folder): self
    {
        // set the owning side of the relation if necessary
        if ($folder->getClient() !== $this) {
            $folder->setClient($this);
        }

        $this->folder = $folder;

        return $this;
    }
    public function getIsNewClient(): ?bool
    {
        return $this->isNewClient;
    }

    public function setIsNewClient(bool $isNewClient): self
    {
        $this->isNewClient = $isNewClient;

        return $this;
    }
}

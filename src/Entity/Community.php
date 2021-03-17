<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\UserCreatedTrait;
use App\Repository\CommunityRepository;
use Doctrine\Common\Collections\Collection;
use App\Entity\Traits\StateTimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CommunityRepository::class)
 */
class Community
{
    use StateTimestampableTrait;
    use UserCreatedTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100,unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="community")
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
      
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
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setCommunity($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCommunity() === $this) {
                $client->setCommunity(null);
            }
        }

        return $this;
    }
}

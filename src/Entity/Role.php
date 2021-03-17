<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoleRepository;
use App\Entity\Traits\UserCreatedTrait;
use App\Entity\Traits\StateTimestampableTrait;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function __toString()
    {
        return $this->getTitle();
    }
}

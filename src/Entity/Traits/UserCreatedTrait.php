<?php

namespace App\Entity\Traits;

use App\Entity\User;
use App\Entity\Employe;
use Doctrine\ORM\Mapping as ORM;

trait UserCreatedTrait
{

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreated;

    public function getUserCreated(): ?User
    {
        return $this->userCreated;
    }

    public function setUserCreated(?User $userCreated): self
    {
        $this->userCreated = $userCreated;

        return $this;
    }
}

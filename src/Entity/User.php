<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\PersonTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use App\Entity\Traits\StateTimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{


    use StateTimestampableTrait;
    use PersonTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     * @Assert\Length(
     *  min=3,minMessage="le login doit faire entre 3 et 10 caracteres",
     *  max=10,maxMessage="le login doit faire entre 3 et 10 caracteres",
     * )
     * @Assert\Length(
     *  min=2,minMessage="Le login est trop court minimum 2 caractéres",
     *  max=15,maxMessage="Le login est trop long maximum 15 caracteres",
     * )
     */
    private $login;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez renseigner son  mot de passe!!")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas correctement confirmé votre mot de passe !")
     */
    public $passwordConfirm;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $ConfidentialityAgreement;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $signedContratAt;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $endOfContractAt;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $servicePlugAt;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class)
     */
    private $userRoles;

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
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
        if (empty($this->partageDonnees)) {
            $this->partageDonnees = true;
        }
        if (empty($this->conditionAdhesion)) {
            $this->conditionAdhesion = true;
        }
        if (empty($this->ConfidentialityAgreement)) {
            $this->ConfidentialityAgreement = true;
        }
        if (empty($this->servicePlugAt)) {
            $this->servicePlugAt = new \DateTime();
        }
        if (empty($this->signedContratAt)) {
            $this->signedContratAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->userRoles->map(function ($role) {
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
    }


    public function getInsuranceEligibleAt(): ?\DateTimeInterface
    {
        return $this->insuranceEligibleAt;
    }

    public function setInsuranceEligibleAt(?\DateTimeInterface $insuranceEligibleAt): self
    {
        $this->insuranceEligibleAt = $insuranceEligibleAt;

        return $this;
    }
    
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getLogin(): string
    {
        return (string) $this->login;
    }

    public function getConfidentialityAgreement(): ?bool
    {
        return $this->ConfidentialityAgreement;
    }

    public function setConfidentialityAgreement(bool $ConfidentialityAgreement): self
    {
        $this->ConfidentialityAgreement = $ConfidentialityAgreement;

        return $this;
    }

    public function getOtherContactParentalBond(): ?string
    {
        return $this->otherContactParentalBond;
    }

    public function setOtherContactParentalBond(?string $otherContactParentalBond): self
    {
        $this->otherContactParentalBond = $otherContactParentalBond;

        return $this;
    }


    public function getServicePlugAt(): ?\DateTimeInterface
    {
        return $this->servicePlugAt;
    }

    public function setServicePlugAt(\DateTimeInterface $servicePlugAt): self
    {
        $this->servicePlugAt = $servicePlugAt;

        return $this;
    }

    public function getSignedContratAt(): ?\DateTimeInterface
    {
        return $this->signedContratAt;
    }

    public function setSignedContratAt(\DateTimeInterface $signedContratAt): self
    {
        $this->signedContratAt = $signedContratAt;

        return $this;
    }

    public function getEndOfContractAt(): ?\DateTimeInterface
    {
        return $this->endOfContractAt;
    }

    public function setEndOfContractAt(\DateTimeInterface $endOfContractAt): self
    {
        $this->endOfContractAt = $endOfContractAt;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        $this->userRoles->removeElement($userRole);

        return $this;
    }
}

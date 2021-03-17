<?php


namespace App\Entity\Traits;

use App\Entity\Traits\StateTimestampableTrait;
use Symfony\Component\Validator\Constraints as Assert;

trait PersonTrait
{

    use StateTimestampableTrait;


    /**
     * @ORM\Column(type="string", length=50,nullable=false)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(
     *  min=2,minMessage="Le nom est trop court, minimum 2 caractéres",
     *  max=200,maxMessage="Le nom est trop long, maximum 200 caractéres",
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Assert\Length(
     *  min=2,minMessage="Le nom est trop court, minimum 2 caractéres",
     *  max=100,maxMessage="Le prénom est trop long, maximum 100 caractéres",
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Le genre doit être renseigné !!")
     * @Assert\Choice(choices={"HOMME","FEMME"},message="le genre doit être HOMME ou FEMME")
     */
    private $genre;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @Assert\NotBlank(message="La date de naissance est obligatire!!")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner l'adresse de résidence !!")
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="saisir que des chiffres."
     * )
     * @Assert\NotBlank(message="Veuillez renseigner son numéro de téléphone")
     */

    private $telephone;

    /**
     * @ORM\Column(type="string", length=25,nullable=true)
     * @Assert\NotBlank(message="Selectionnez la situation matrimoniale !!")
     * @Assert\Choice(choices={"MARIE","CELIBATAIRE","VEUVE","VEUF","DIVORCE"},message="Veuillez renseigner la SM parmi la liste si dessous")
     */
    private $SM;

    /**
     * @ORM\Column(type="string", length=50, nullable=true,unique=true)
     * @Assert\Email(
     *   message = "L'email '{{ value }}' n'est pas valide !!",
     * )
     */
    private $email;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\NotBlank(message="veuillez renseigner son  activité!!")
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(
     *  min=3,minMessage="Trop court au moins entre 3 et 200 lettres",
     *  max=10,maxMessage="Trop long au moins entre 3 et 200 lettres",
     * )
     */
    private $lieuNaiss;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner la nationalité!!")
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Selectionnez le type d'identification !!")
     * @Assert\Choice(choices={"CNI","PASSEPORT","PERMIT"},message="veuillez choisir son type d'identification parmi la liste si dessous")
     */
    private $typePieceIdentity;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="Saisir le numéro de la piéce !!")
     */
    private $numeroPieceIdentity;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank(message="La date délivrqnce doit être renseignee !!")
     */
    private $dateDelivrance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(
     * min="1",
     * max="2",
     * minMessage="minimum 1 chiffres",
     * maxMessage="maximum 2 chiffres")
     * @Assert\NotBlank(message="veuillez renseigner la taille de la famille")
     * @Assert\Positive(message="veuillez renseigner un nombre superieur a zero")
     * @Assert\Type(type="integer", message="Veuillez renseigner un nombre sans virgule")
     */
    private $tailleFamille;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner le nom complet de cet autre personne a contacter!!")
     */
    private $otherContactFullName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner le numéro de telephone de cet autre personne a contacter!!")
     */
    private $otherContactPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez indiquer le lien de parenté avec cet qutre personne!!")
     */
    private $otherContactParentalBond;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $insuranceEligibleAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $conditionAdhesion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $partageDonnees;

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }


    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }
    public function setDateNaiss($dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone($telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSM(): ?string
    {
        return $this->SM;
    }

    public function setSM(string $SM): self
    {
        $this->SM = $SM;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }



    public function getLieuNaiss(): ?string
    {
        return $this->lieuNaiss;
    }

    public function setLieuNaiss(?string $lieuNaiss): self
    {
        $this->lieuNaiss = $lieuNaiss;

        return $this;
    }

    public function getTypePieceIdentity(): ?string
    {
        return $this->typePieceIdentity;
    }

    public function setTypePieceIdentity(?string $typePieceIdentity): self
    {
        $this->typePieceIdentity = $typePieceIdentity;

        return $this;
    }

    public function getNumeroPieceIdentity(): ?string
    {
        return $this->numeroPieceIdentity;
    }

    public function setNumeroPieceIdentity(?string $numeroPieceIdentity): self
    {
        $this->numeroPieceIdentity = $numeroPieceIdentity;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->dateDelivrance;
    }

    public function setDateDelivrance($dateDelivrance): self
    {
        $this->dateDelivrance = $dateDelivrance;

        return $this;
    }

    public function getTailleFamille(): ?int
    {
        return $this->tailleFamille;
    }

    public function setTailleFamille($tailleFamille): self
    {
        $this->tailleFamille = $tailleFamille;

        return $this;
    }

    public function getConditionAdhesion(): ?bool
    {
        return $this->conditionAdhesion;
    }

    public function setConditionAdhesion(bool $conditionAdhesion): self
    {
        $this->conditionAdhesion = $conditionAdhesion;

        return $this;
    }

    public function getPartageDonnees(): ?bool
    {
        return $this->partageDonnees;
    }

    public function setPartageDonnees(bool $partageDonnees): self
    {
        $this->partageDonnees = $partageDonnees;

        return $this;
    }


    public function getOtherContactFullName(): ?string
    {
        return $this->otherContactFullName;
    }

    public function setOtherContactFullName(?string $otherContactFullName): self
    {
        $this->otherContactFullName = $otherContactFullName;

        return $this;
    }

    public function getOtherContactPhone(): ?int
    {
        return $this->otherContactPhone;
    }

    public function setOtherContactPhone(?int $otherContactPhone): self
    {
        $this->otherContactPhone = $otherContactPhone;

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


    public function __toString()
    {
        return $this->getPrenom() . " " . $this->getNom();
    }
}

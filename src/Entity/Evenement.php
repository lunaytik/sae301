<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nom = null;

    #[ORM\Column(length: 70)]
    private ?string $realisateur = null;

    #[ORM\Column(length: 10000)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cast = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $affiche = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lieu $lieu = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Tag $Tag = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etoile = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: LigneReservation::class)]
    private Collection $ligneReservations;

    public function __construct()
    {
        $this->ligneReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCast(): ?string
    {
        return $this->cast;
    }

    public function setCast(?string $cast): self
    {
        $this->cast = $cast;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getTag(): ?Tag
    {
        return $this->Tag;
    }

    public function setTag(?Tag $Tag): self
    {
        $this->Tag = $Tag;

        return $this;
    }

    public function getEtoile(): ?string
    {
        return $this->etoile;
    }

    public function setEtoile(?string $etoile): self
    {
        $this->etoile = $etoile;

        return $this;
    }

    /**
     * @return Collection<int, LigneReservation>
     */
    public function getLigneReservations(): Collection
    {
        return $this->ligneReservations;
    }

    public function addLigneReservation(LigneReservation $ligneReservation): self
    {
        if (!$this->ligneReservations->contains($ligneReservation)) {
            $this->ligneReservations->add($ligneReservation);
            $ligneReservation->setEvent($this);
        }

        return $this;
    }

    public function removeLigneReservation(LigneReservation $ligneReservation): self
    {
        if ($this->ligneReservations->removeElement($ligneReservation)) {
            // set the owning side to null (unless already changed)
            if ($ligneReservation->getEvent() === $this) {
                $ligneReservation->setEvent(null);
            }
        }

        return $this;
    }
}

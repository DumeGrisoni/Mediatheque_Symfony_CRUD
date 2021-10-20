<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 * @Vich\Uploadable
 * @ORM\Table(name="livre", indexes={@ORM\Index(columns={"titre","auteur"}, flags={"fulltext"})})
 */
class Livre
{
    const GENRE= [
        'Fantastique' => 'Fantastique',
        'Romance' => 'Romance',
        'Aventure' => 'Aventure',
        'Enfance' => 'Enfance',
        'Sci-Fi' => 'Sci-Fi',
        'Manga' => 'Manga',
        'Dark Fantasy' => 'Dark Fantasy'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_parution;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $file;

    /**
     * @Vich\UploadableField(mapping="images_livres", fileNameProperty="file")
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $disponible;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $date_emprunt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $date_retour;

    /**
     * @ORM\ManyToOne(targetEntity=Inscrit::class, inversedBy="livre")
     */
    private ?Inscrit $inscrit;

    /**
     * @ORM\Column (type="boolean", nullable=true)
     */
    private $confirme;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDateParution(): ?\DateTimeInterface
    {
        return $this->date_parution;
    }

    public function setDateParution(\DateTimeInterface $date_parution): self
    {
        $this->date_parution = $date_parution;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * @return string
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return self
     */
    public function setFile( $file): self
    {
        $this->file = $file;
        return $this;
    }


    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $file
     * @return $this
     */
    public function setImageFile(File $file=null): self
    {
        $this->imageFile = $file;
        if ($file){
            $this->disponible = true;
        }
        return $this;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->date_emprunt;
    }

    public function setDateEmprunt(?\DateTimeInterface $date_emprunt): self
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(?\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getInscrit(): ?Inscrit
    {
        return $this->inscrit;
    }

    public function setInscrit(?Inscrit $inscrit): self
    {
        $this->inscrit = $inscrit;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirme()
    {
        return $this->confirme;
    }

    /**
     * @param mixed $confirme
     * @return Livre
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;
        return $this;
    }




}

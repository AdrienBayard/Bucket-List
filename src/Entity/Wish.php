<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: WishRepository::class)]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 250)]
    private $title;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private $description;

    #[Assert\Length(max: 50, maxMessage: "Le nom est trop long.")]
    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[ORM\Column(type: 'boolean')]
    private $isPublished;

    #[ORM\Column(type: 'datetime')]
    private $dateCreated;

    public function __construct()   // créer par nous même afin de générer la date du jour pour la date et heure des messages
                                    // idem pour la case 'isPublished' qui est cochée par défaut
                                    // on crée cette fonction __construct afin de proposer nos modifications
    {
        $this->dateCreated = new \DateTime();
        $this->isPublished=true;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}

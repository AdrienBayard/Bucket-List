<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;



    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Wish::class, orphanRemoval: false)]
    private $wishes;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->wishes = new ArrayCollection();
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
     * @return Collection|Wish[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Wish $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setCategories($this);
        }

        return $this;
    }

    public function removeCategory(Wish $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategories() === $this) {
                $category->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wish[]
     */
    public function getWishes(): Collection
    {
        return $this->wishes;
    }

    public function addWish(Wish $wish): self
    {
        if (!$this->wishes->contains($wish)) {
            $this->wishes[] = $wish;
            $wish->setCategorie($this);
        }

        return $this;
    }

    public function removeWish(Wish $wish): self
    {
        if ($this->wishes->removeElement($wish)) {
            // set the owning side to null (unless already changed)
            if ($wish->getCategorie() === $this) {
                $wish->setCategorie(null);
            }
        }

        return $this;
    }

/*    public function __toString(): string
            //permet de transformer name en string
    {
        return $this-> name;
    }*/


}

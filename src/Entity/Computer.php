<?php

namespace App\Entity;

use App\Repository\ComputerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComputerRepository::class)]
class Computer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'computers')]
    private ?Brand $marque = null;

    #[ORM\Column]
    private ?bool $isVisible = null;

    #[ORM\Column(length: 255)]
    private ?string $serieNumber = null;

    #[ORM\ManyToOne(inversedBy: 'computers')]
    private ?User $author = null;

    #[ORM\OneToMany(mappedBy: 'computers', targetEntity: AnnonceListByUser::class)]
    private Collection $usersFav;

    public function __construct()
    {
        $this->usersFav = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMarque(): ?Brand
    {
        return $this->marque;
    }

    public function setMarque(?Brand $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function isIsVisible(): ?bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    public function getSerieNumber(): ?string
    {
        return $this->serieNumber;
    }

    public function setSerieNumber(string $serieNumber): self
    {
        $this->serieNumber = $serieNumber;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, AnnonceListByUser>
     */
    public function getUsersFav(): Collection
    {
        return $this->usersFav;
    }

    public function addUsersFav(AnnonceListByUser $usersFav): self
    {
        if (!$this->usersFav->contains($usersFav)) {
            $this->usersFav->add($usersFav);
            $usersFav->setComputers($this);
        }

        return $this;
    }

    public function removeUsersFav(AnnonceListByUser $usersFav): self
    {
        if ($this->usersFav->removeElement($usersFav)) {
            // set the owning side to null (unless already changed)
            if ($usersFav->getComputers() === $this) {
                $usersFav->setComputers(null);
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function isUsersFav (User $user): bool
    {
        foreach($this->usersFav as $usersFav) {
            if($usersFav ->getUsers() === $user) return true;
        }
        return false;
    }
}

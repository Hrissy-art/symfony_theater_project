<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Title is required')]
    #[Assert\Length(max: 50)]
    #[assert\File(maxSize: '50k')]


    private ?string $nameShow = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createdOn = null;

    #[ORM\Column]
    private ?bool $visible = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;

    #[ORM\ManyToOne(inversedBy: 'name')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $summaryShow = null;

    #[ORM\ManyToMany(targetEntity: Theater::class, mappedBy: 'name')]
    private Collection $theaters;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    #[ORM\ManyToOne(inversedBy: 'name')]
    private ?User $user = null;

    public function __construct()
    {
        $this->theaters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameShow(): ?string
    {
        return $this->nameShow;
    }

    public function setNameShow(string $nameShow): static
    {
        $this->nameShow = $nameShow;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTimeInterface $createdOn): static
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSummaryShow(): ?string
    {
        return $this->summaryShow;
    }

    public function setSummaryShow(?string $summaryShow): static
    {
        $this->summaryShow = $summaryShow;

        return $this;
    }

    /**
     * @return Collection<int, Theater>
     */
    public function getTheaters(): Collection
    {
        return $this->theaters;
    }

    public function addTheater(Theater $theater): static
    {
        if (!$this->theaters->contains($theater)) {
            $this->theaters->add($theater);
            $theater->addArticle($this);
        }

        return $this;
    }

    public function removeTheater(Theater $theater): static
    {
        if ($this->theaters->removeElement($theater)) {
            $theater->removeArticle($this);
        }

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

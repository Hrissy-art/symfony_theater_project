<?php

namespace App\Entity;

use App\Repository\TheaterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TheaterRepository::class)]
class Theater
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'theaters')]
    private Collection $articles; // Changer le nom de la propriété pour éviter la confusion

    public function __construct()
    {
        $this->articles = new ArrayCollection(); // Changer le nom de la propriété pour éviter la confusion
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection // Changer le nom de la méthode pour éviter la confusion
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static // Changer le nom du paramètre pour éviter la confusion
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
        }

        return $this;
    }

    public function removeArticle(Article $article): static // Changer le nom du paramètre pour éviter la confusion
    {
        $this->articles->removeElement($article);

        return $this;
    }
}

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

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'theaters')]
    private Collection $name;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(Article $name): static
    {
        if (!$this->name->contains($name)) {
            $this->name->add($name);
        }

        return $this;
    }

    public function removeName(Article $name): static
    {
        $this->name->removeElement($name);

        return $this;
    }
}

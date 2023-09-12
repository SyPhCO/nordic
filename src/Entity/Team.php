<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\Column]
    private ?bool $header = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery4 = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function isHeader(): ?bool
    {
        return $this->header;
    }

    public function setHeader(bool $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getGallery(): ?string
    {
        return $this->gallery;
    }

    public function setGallery(?string $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    public function getGallery2(): ?string
    {
        return $this->gallery2;
    }

    public function setGallery2(?string $gallery2): self
    {
        $this->gallery2 = $gallery2;

        return $this;
    }

    public function getGallery3(): ?string
    {
        return $this->gallery3;
    }

    public function setGallery3(?string $gallery3): self
    {
        $this->gallery3 = $gallery3;

        return $this;
    }

    public function getGallery4(): ?string
    {
        return $this->gallery4;
    }

    public function setGallery4(?string $gallery4): self
    {
        $this->gallery4 = $gallery4;

        return $this;
    }
}

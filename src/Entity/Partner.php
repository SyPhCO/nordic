<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $illustration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contact = null;
    
    #[ORM\Column(length: 255)]
    private ?string $btnTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $btnUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gallery6 = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getBtnTitle(): ?string
    {
        return $this->btnTitle;
    }

    public function setBtnTitle(string $btnTitle): self
    {
        $this->btnTitle = $btnTitle;

        return $this;
    }

    public function getBtnUrl(): ?string
    {
        return $this->btnUrl;
    }

    public function setBtnUrl(string $btnUrl): self
    {
        $this->btnUrl = $btnUrl;

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
    public function getGallery5(): ?string
    {
        return $this->gallery5;
    }

    public function setGallery5(?string $gallery5): self
    {
        $this->gallery5 = $gallery5;

        return $this;
    }    public function getGallery6(): ?string
    {
        return $this->gallery6;
    }

    public function setGallery6(?string $gallery6): self
    {
        $this->gallery6 = $gallery6;

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
}

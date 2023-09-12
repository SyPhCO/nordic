<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\Column(length: 255)]
    private ?string $subtitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'products')]
    private Collection $category;

    #[ORM\Column]
    private ?bool $isBest = null;
    
    #[ORM\Column]
    private ?bool $isDog = null;

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

    #[ORM\OneToMany(mappedBy: 'activity', targetEntity: Comments::class)]
    private Collection $comments;


    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->getName();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

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

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function isIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(bool $isBest): self
    {
        $this->isBest = $isBest;

        return $this;
    }

    public function isIsDog(): ?bool
    {
        return $this->isDog;
    }

    public function setIsDog(bool $isDog): self
    {
        $this->isDog = $isDog;

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

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setActivity($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getActivity() === $this) {
                $comment->setActivity(null);
            }
        }

        return $this;
    }


}

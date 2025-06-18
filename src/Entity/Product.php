<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $name;

    #[ORM\Column(length: 30)]
    private string $color;

    #[ORM\Column(length: 60, unique: true)]
    private string $reference = '';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $price;

    #[ORM\Column(length: 10)]
    private string $size;

    #[ORM\Column(length: 20)]
    private string $status = 'to_integrate'; // ou 'in_stock'

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Supplier $supplier = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Season $season = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Stock::class)]
    private Collection $stocks;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }

    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function getId(): ?int { return $this->id; }

    public function getName(): string { return $this->name; }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getColor(): string { return $this->color; }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function getReference(): string { return $this->reference; }

    public function getPrice(): float { return $this->price; }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getSize(): string { return $this->size; }

    public function setSize(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function getStatus(): string { return $this->status; }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getSupplier(): ?Supplier { return $this->supplier; }

    public function setSupplier(Supplier $supplier): self
    {
        $this->supplier = $supplier;
        return $this;
    }

    public function getSeason(): ?Season { return $this->season; }

    public function setSeason(Season $season): self
    {
        $this->season = $season;
        return $this;
    }

    public function getCategory(): ?Category { return $this->category; }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    #[ORM\PrePersist]
    public function generateReference(): void
    {
        if (!$this->reference && $this->supplier && $this->name && $this->color) {
            $supplierPart = substr(str_replace(' ', '', $this->supplier->getName()), 0, 6);
            $namePart = substr(str_replace(' ', '_', $this->name), 0, 25);
            $colorPart = str_replace(' ', '_', $this->color);
            $this->reference = strtoupper("{$supplierPart}_{$namePart}_{$colorPart}");
        }
    }
}

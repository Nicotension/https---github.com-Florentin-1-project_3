<?php
namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "fk_user_id_id", nullable: false)] // Adjust column name
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "fk_product_id_id", nullable: false)] // Adjust column name
    private ?Product $product = null;





    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

   

   
}
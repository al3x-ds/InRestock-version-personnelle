<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueStockRepository")
 */
class HistoriqueStock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $variation;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="integer")
     */
    private $newStock;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getVariation(): ?int
    {
        return $this->variation;
    }
    public function setVariation(int $variation): self
    {
        $this->variation = $variation;
        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function __toString(){
        return $this->id;
    }
    public function getNewStock(): ?int
    {
        return $this->newStock;
    }
    public function setNewStock(int $newStock): self
    {
        $this->newStock = $newStock;
        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }
    public function setUser(string $user): self
    {
        $this->user = $user;
        return $this;
    }
    public function getProduct(): ?string
    {
        return $this->product;
    }
    public function setProduct(string $product): self
    {
        $this->product = $product;
        return $this;
    }
}
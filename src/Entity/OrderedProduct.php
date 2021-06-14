<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderedProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"orderedProduct:read"}},
 *     denormalizationContext={"groups"={"orderedProduct:write"}}
 * )
 * @ORM\Entity(repositoryClass=OrderedProductRepository::class)
 */
class OrderedProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"orderedProduct:read", "orders:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="orderedProducts")
     * @Groups({"orders:write"})
     */
    private $ordered_prod_order;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="orderedProducts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"orders:write"})
     */
    private $product;

    /**
     * @ORM\Column(type="float")
     * @Groups({"orders:write"})
     */
    private $price;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"orders:write"})
     */
    private $quantity;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderedProdOrder(): ?Orders
    {
        return $this->ordered_prod_order;
    }

    public function setOrderedProdOrder(?Orders $ordered_prod_order): self
    {
        $this->ordered_prod_order = $ordered_prod_order;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderedProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrderedProductRepository::class)
 */
class OrderedProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="orderedProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_id;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="orderedProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordered_prod_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?Orders
    {
        return $this->order_id;
    }

    public function setOrderId(?Orders $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getProductId(): ?Products
    {
        return $this->product_id;
    }

    public function setProductId(?Products $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getOrderedProdPrice(): ?int
    {
        return $this->ordered_prod_price;
    }

    public function setOrderedProdPrice(?int $ordered_prod_price): self
    {
        $this->ordered_prod_price = $ordered_prod_price;

        return $this;
    }
}

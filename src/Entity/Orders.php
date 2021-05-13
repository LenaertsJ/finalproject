<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $order_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $order_total_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $order_total_prod;

    /**
     * @ORM\OneToMany(targetEntity=OrderedProduct::class, mappedBy="order_id", orphanRemoval=true)
     */
    private $orderedProducts;

    /**
     * @ORM\ManyToOne(targetEntity=OrderStatus::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_stat;

    public function __construct()
    {
        $this->orderedProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->order_date;
    }

    public function setOrderDate(\DateTimeInterface $order_date): self
    {
        $this->order_date = $order_date;

        return $this;
    }

    public function getOrderTotalPrice(): ?int
    {
        return $this->order_total_price;
    }

    public function setOrderTotalPrice(?int $order_total_price): self
    {
        $this->order_total_price = $order_total_price;

        return $this;
    }

    public function getOrderTotalProd(): ?int
    {
        return $this->order_total_prod;
    }

    public function setOrderTotalProd(?int $order_total_prod): self
    {
        $this->order_total_prod = $order_total_prod;

        return $this;
    }

    /**
     * @return Collection|OrderedProduct[]
     */
    public function getOrderedProducts(): Collection
    {
        return $this->orderedProducts;
    }

    public function addOrderedProduct(OrderedProduct $orderedProduct): self
    {
        if (!$this->orderedProducts->contains($orderedProduct)) {
            $this->orderedProducts[] = $orderedProduct;
            $orderedProduct->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderedProduct(OrderedProduct $orderedProduct): self
    {
        if ($this->orderedProducts->removeElement($orderedProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderedProduct->getOrderId() === $this) {
                $orderedProduct->setOrderId(null);
            }
        }

        return $this;
    }

    public function getOrderStat(): ?OrderStatus
    {
        return $this->order_stat;
    }

    public function setOrderStat(?OrderStatus $order_stat): self
    {
        $this->order_stat = $order_stat;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"orders:read"}},
 *     denormalizationContext={"groups"={"orders:write"}}
 * )
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"orders:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"orders:read"})
     */
    private $order_date;

    /**
     * @ORM\OneToMany(targetEntity=OrderedProduct::class, mappedBy="order_id", orphanRemoval=true)
     * @Groups({"orders:read"})
     */
    private $orderedProducts;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"orders:read"})
     */
    private $address;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"orders:read", "orders:write"})
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"orders:read", "orders:write"})
     */
    private $totalItems;


    public function __construct()
    {
        $this->orderedProducts = new ArrayCollection();
        $this->order_date = new \DateTime();
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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getTotalItems(): ?int
    {
        return $this->totalItems;
    }

    public function setTotalItems(?int $totalItems): self
    {
        $this->totalItems = $totalItems;

        return $this;
    }

}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PricesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PricesRepository::class)
 */
class Prices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="prices")
     */
    private $product;

    /**
     * @ORM\Column(type="float")
     */
    private $nettoPrice;

    /**
     * @ORM\Column(type="float")
     * @Groups({"products:read"})
     */
    private $brutoPrice;


    public function __construct()
    {

        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getNettoPrice(): ?float
    {
        return $this->nettoPrice;
    }

    public function setNettoPrice(float $nettoPrice): self
    {
        $this->nettoPrice = $nettoPrice;
        if($nettoPrice)
        {
            $this->brutoPrice = round($nettoPrice + ($nettoPrice * .21), 1);
        }

        return $this;
    }

    public function getBrutoPrice(): ?float
    {
        return $this->brutoPrice;
    }

    public function setBrutoPrice(float $brutoPrice): self
    {
        $this->brutoPrice = $brutoPrice;

        return $this;
    }

    public function __toString()
    {
        return strval($this->brutoPrice);
    }
}

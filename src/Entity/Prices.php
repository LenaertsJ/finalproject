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
     * @ORM\Column(type="smallint")
     * @Groups({"products:read"})
     */
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="prices")
     */
    private $product;


    public function __construct()
    {

        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

//    public function setDate(\DateTimeInterface $date): self
//    {
//        $this->date = $date;
//
//        return $this;
//    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }
}

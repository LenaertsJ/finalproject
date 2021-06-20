<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"address:read"}},
 *     denormalizationContext={"groups"={"address:write"}},
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"},
 * )
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"address:read", "orders:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"address:write"})
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"address:write"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"address:write"})
     */
    private $country;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"address:write"})
     */
    private $postalCode;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"address:write"})
     */
    private $houseNumber;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="address")
     */
    private $orders;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"address:write"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"address:write"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"address:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"address:write"})
     */
    private $phonenumber;



    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->street . ' ' . strval($this->houseNumber) . ', ' . strval($this->postalCode) . ' ' . $this->city . ', ' . $this->country;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setAddress($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getAddress() === $this) {
                $order->setAddress(null);
            }
        }

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getHouseNumber(): ?int
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(int $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

}

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
 *     denormalizationContext={"groups"={"address:write"}}
 * )
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"address:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"address:read", "address:write", "orders:read"})
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"address:read", "address:write", "orders:read"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"address:read", "address:write", "orders:read"})
     */
    private $country;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"address:read", "address:write", "orders:read"})
     */
    private $postalCode;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"address:read", "address:write", "orders:read"})
     */
    private $houseNumber;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="address")
     * @Groups({"address:read", "orders:read"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="address")
     * @Groups({"address:read"})
     */
    private $orders;



    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->customer = new ArrayCollection();
        $this->orders = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAddress($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAddress() === $this) {
                $user->setAddress(null);
            }
        }

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

}

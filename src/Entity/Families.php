<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FamiliesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FamiliesRepository::class)
 */
class Families
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"plants:read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Plants::class, mappedBy="family")
     */
    private $plants;

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Plants[]
     */
    public function getPlants(): Collection
    {
        return $this->plants;
    }

    public function addPlant(Plants $plant): self
    {
        if (!$this->plants->contains($plant)) {
            $this->plants[] = $plant;
            $plant->setFamily($this);
        }

        return $this;
    }

    public function removePlant(Plants $plant): self
    {
        if ($this->plants->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getFamily() === $this) {
                $plant->setFamily(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}

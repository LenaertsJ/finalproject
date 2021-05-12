<?php

namespace App\Entity;

use App\Repository\PlantsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlantsRepository::class)
 */
class Plants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $latin_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $symbolism;

    /**
     * @ORM\ManyToOne(targetEntity=Families::class, inversedBy="plants")
     */
    private $family;

    /**
     * @ORM\ManyToMany(targetEntity="Qualities")
     * @ORM\JoinTable(name="plant_qualities")
     */
    private $plantQualities;

    public function __construct()
    {
        $this->plantQualities = new ArrayCollection();
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

    public function getLatinName(): ?string
    {
        return $this->latin_name;
    }

    public function setLatinName(?string $latin_name): self
    {
        $this->latin_name = $latin_name;

        return $this;
    }

    public function getSymbolism(): ?string
    {
        return $this->symbolism;
    }

    public function setSymbolism(?string $symbolism): self
    {
        $this->symbolism = $symbolism;

        return $this;
    }

    public function getFamily(): ?Families
    {
        return $this->family;
    }

    public function setFamily(?Families $family): self
    {
        $this->family = $family;

        return $this;
    }
    
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QualitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=QualitiesRepository::class)
 */
class Qualities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * Plant with this quality.
     *
     * @var Plants[]
     * @ORM\ManyToMany(targetEntity="Plants", mappedBy="qualities")
     **/
    protected $plants;

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

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add a plant to the quality.
     *
     * @param $plant Plants The product to associate
     */
    public function addPlant(Plants $plant)
    {
        if ($this->plants->contains($plant)) {
            return;
        }

        $this->plants->add($plant);
        $plant->addQuality($this);
    }

    /**
     * @param Plants $plant
     */
    public function removePlant(Plants $plant)
    {
        if (!$this->plants->contains($plant)) {
            return;
        }

        $this->plants->removeElement($plant);
        $plant->removeQuality($this);
    }
}

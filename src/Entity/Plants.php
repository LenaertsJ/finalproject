<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\PlantsRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"plants:read"}},
 *     denormalizationContext={"groups"={"plants:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"name":"partial"})
 * @ORM\Entity(repositoryClass=PlantsRepository::class)
 * @Vich\Uploadable
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
     * @Groups({"plants:read","qualities:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"plants:read", "qualities:read"})
     */
    private $latin_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"plants:read"})
     */
    private $symbolism;

    /**
     * @ORM\ManyToOne(targetEntity=Families::class, inversedBy="plants")
     * @Groups({"plants:read"})
     */
    private $family;

    /**
     * @var Qualities[]
     * @ORM\ManyToMany(targetEntity="Qualities", inversedBy="plants")
     * @ORM\JoinTable(name="plant_qualities")
     * @Groups({"plants:read"})
     */
    private $qualities;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"plants:read"})
     */
    private $image;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="images", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->qualities = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return "http://localhost:8000/resources/images/" . $this->image;
    }

    /**
     * @param mixed $image
     * TODO : reformat image title to lowercase and no spaces.
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile($imageFile): void
    {
        $this->imageFile = $imageFile;
        if($imageFile){
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * Get all associated categories.
     *
     * @return Qualities[]
     */
    public function getQualities()
    {
        return $this->qualities;
    }

    /**
     * Set all categories of the product.
     *
     * @param Qualities[] $qualities
     */
    public function setQualities(array $qualities)
    {
        // This is the owning side, we have to call remove and add to have change in the category side too.
        foreach ($this->getQualities() as $quality) {
            $this->removeQuality($quality);
        }
        foreach ($qualities as $quality) {
            $this->addQuality($quality);
        }
    }

    /**
     * Add a quality in the plant association.
     * (Owning side).
     *
     * @param $quality Qualities the quality to associate
     */
    public function addQuality(Qualities $quality)
    {
        if ($this->qualities->contains($quality)) {
            return;
        }

        $this->qualities->add($quality);
        $quality->addPlant($this);
    }

    /**
     * Remove a quality in the plant association.
     * (Owning side).
     *
     * @param $quality Qualities the category to associate
     */
    public function removeQuality(Qualities $quality)
    {
        if (!$this->qualities->contains($quality)) {
            return;
        }

        $this->qualities->removeElement($quality);
        $quality->removePlant($this);
    }

}

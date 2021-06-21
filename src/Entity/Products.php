<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"products:read"}},
 *     denormalizationContext={"groups"={"products:write"}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"category.name":"partial"})
 * @ApiFilter(RangeFilter::class, properties={"stock"})
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @Vich\Uploadable
 */


class Products
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"products:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"products:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"products:read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products")
     * @Groups({"products:read"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Prices::class, mappedBy="product", cascade={"persist", "remove"})
     * @Groups({"products:read"})
     */
    private $prices;

    /**
     * @ORM\ManyToMany(targetEntity=Plants::class, inversedBy="products")
     * @Groups({"products:read"})
     */
    private $plants;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products:read"})
     */
    private $image;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="images", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products:read"})
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"products:read"})
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity=OrderedProduct::class, mappedBy="product", cascade={})
     */
    private $orderedProducts;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->prices = new ArrayCollection();
        $this->plants = new ArrayCollection();
        $this->orderedProducts = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
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
        //wanneer er een imagefile bestaat dan wordt hieraan een dateTime toegekend en wordt ook de imageURL gezet voor gebruik in de frontend applicatie.
        if($imageFile){
            $this->updatedAt = new \DateTime();
            $this->imageUrl = "https://wdev2.be/julie21/eindwerk/resources/image.php/" . $this->name . ".jpg?image=/julie21/eindwerk/resources/images/" . $this->image;

        }
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return Collection|Prices[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Prices $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setProduct($this);
        }

        return $this;
    }

    public function removePrice(Prices $price): self
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getProduct() === $this) {
                $price->setProduct(null);
            }
        }

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
        }

        return $this;
    }

    public function removePlant(Plants $plant): self
    {
        $this->plants->removeElement($plant);

        return $this;
    }



    public function __toString(){
        return $this->name;
    }

    public function getStock(): ?int
    {
        return $this->stock;
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
            $orderedProduct->setProduct($this);
        }

        return $this;
    }

    public function removeOrderedProduct(OrderedProduct $orderedProduct): self
    {
        if ($this->orderedProducts->removeElement($orderedProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderedProduct->getProduct() === $this) {
                $orderedProduct->setProduct(null);
            }
        }

        return $this;
    }



}

<?php


namespace App\EventListener;


use App\Entity\OrderedProduct;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

//EventListener om de voorraad van producten aan te passen wanneer er nieuwe records worden toegevoegd in de orderedProduct tabel.
class OrderedProductEventListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if($entity instanceof OrderedProduct)
        {
            //Ophalen van het product dat gelinkt is aan het orderedProduct.
            $productID = $entity->getProduct();
            $repository = $this->entityManager->getRepository(Products::class);
            $product = $repository->findOneBy(['id' => $productID]);

            //Opvragen van de voorraad van dit product.
            $stock = $product->getStock();
            //De hoeveelheid van het product dat werd besteld aftrekken van de voorraad die beschikbaar was voor dit product.
            $newStock = $stock - $entity->getQuantity();
            //Als de nieuwe voorraad minder dan 0 zou zijn (wat in principe vanuit de frontend al wordt voorkomen) wordt de voorraad toch gewoon op nul gezet.
            if($newStock < 0)
            {
                $newStock = 0;
            }
            $product->setStock($newStock);

            //opslaan van product met gewijzigde voorraad.
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }

    }
}
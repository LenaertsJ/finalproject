<?php


namespace App\EventListener;


use App\Entity\OrderedProduct;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

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
            $productID = $entity->getProduct();
            $repository = $this->entityManager->getRepository(Products::class);
            $product = $repository->findOneBy(['id' => $productID]);

            $stock = $product->getStock();
            $newStock = $stock - $entity->getQuantity();
            $product->setStock($newStock);

            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }

    }
}
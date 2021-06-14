<?php


namespace App\EventSubscribers;


use App\Entity\Plants;
use App\Entity\Products;
use App\Entity\Qualities;
use App\Entity\User;
use App\services\StringFunctions;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $stringFunctions;
    private $entityManager;

    public function __construct(StringFunctions $stringFunctions, EntityManagerInterface $entityManager){
        $this->stringFunctions = $stringFunctions;
        $this->entityManager = $entityManager;
    }


    public static function getSubscribedEvents()
    {
        return[
            AfterEntityPersistedEvent::class => ['stripTags']
        ];
    }

    public function stripTags(AfterEntityPersistedEvent $event){
        $entity = $event->getEntityInstance();
        if (($entity instanceof Products) || ($entity instanceof Qualities)){
            $stripped = $this->stringFunctions->removeTags($entity->getDescription());
            $entity->setDescription($stripped);
        } elseif ($entity instanceof Plants){
            $stripped = $this->stringFunctions->removeTags($entity->getSymbolism());
            $entity->setSymbolism($stripped);
        } else {
            return;
        }
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
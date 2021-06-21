<?php


namespace App\EventSubscribers;


use App\Entity\Plants;
use App\Entity\Products;
use App\services\StringFunctions;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


//EventSubscriber om html tags uit de input van textarea's te halen.

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

    public function stripTags(AfterEntityPersistedEvent $persistEvent){

        //Opgeslagen record wordt in variabele gestoken die vervolgens door de stringFunctions service gehaald kan worden.
        $entity = $persistEvent->getEntityInstance();


            if ($entity instanceof Products){
                $stripped = $this->stringFunctions->removeTags($entity->getDescription());
                $entity->setDescription($stripped);
            } elseif ($entity instanceof Plants){
                $stripped = $this->stringFunctions->removeTags($entity->getSymbolism());
                $entity->setSymbolism($stripped);
            } else {
                return;
            }

            //aangepast record wordt opnieuw opgeslagen in de database.
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
<?php


namespace App\EventSubscribers;


use App\Entity\Plants;
use App\Entity\Products;
use App\Entity\Qualities;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $stringFunctions;

    public function __construct($stringFunctions){
        $this->stringFunctions = $stringFunctions;
    }


    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return[
            BeforeEntityPersistedEvent::class => ['setImageSlug'],
        ];
    }

    public function setImageSlug(BeforeEntityPersistedEvent $event){
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Products) || !($entity instanceof Plants)){
            return;
        }

        $slug = $this->stringFunctions->slugify($entity->getImage());
        $entity->setImage($slug);
    }

    public function stripTags(BeforeEntityPersistedEvent $event){
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Products) || !($entity instanceof Plants) || !($entity instanceof Qualities)){
            return;
        }

        if($entity instanceof Plants){
            $stripped = $this->stringFunctions->strip_tags($entity->getSymbolism());
            $entity->setSymbolism($stripped);
        }

        $stripped = $this->stringFunctions->strip_tags($entity->getDescription());
        $entity->setDescription($stripped);
    }
}
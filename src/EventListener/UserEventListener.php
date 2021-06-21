<?php


namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UserEventListener
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {

            //Nagaan of isAdmin true of false is en dit opslaan in variabele.
            $currentRights = $entity->getIsAdmin();
            $currentRole = $entity->getRoles();

            //Niets doen indien de user een SUPER_ADMIN is. isAdmin boolean heeft geen effect op deze user en rechten kunnen dus niet per ongeluk gedegradeerd worden tot ROLE_ADMIN
            if($currentRole[0] === "ROLE_SUPER_ADMIN"){
                return;
                //als isAdmin op true werd gezet de rol van de gebruiker setten op ROLE_ADMIN
            } elseif ($currentRights) {
                $entity->setRoles(["ROLE_ADMIN"]);
                $this->entityManager->persist($entity);
                //als isAdmin op false werd gezet de rol van de gebruiker setten op ROLE_USER
            } else {
                $entity->setRoles(["ROLE_USER"]);
                $this->entityManager->persist($entity);
            }

            $this->entityManager->flush();
        }
    }
}
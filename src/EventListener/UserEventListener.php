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

            $currentRights = $entity->getIsAdmin();
            $currentRole = $entity->getRoles();
            
            if($currentRole[0] === "ROLE_SUPER_ADMIN"){
                return;
            } elseif ($currentRights) {
                $entity->setRoles(["ROLE_ADMIN"]);
                $this->entityManager->persist($entity);
            } else {
                $entity->setRoles(["ROLE_USER"]);
                $this->entityManager->persist($entity);
            }

            $this->entityManager->flush();
        }
    }
}
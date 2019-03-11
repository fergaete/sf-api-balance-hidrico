<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\BaseEntity;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * Class TimestampableSubscriber
 * @package AppBundle\EventListener
 */
class TimestampableSubscriber implements EventSubscriber {

    /**
     * Returns an array of events this subscriber wants to listen to.
     * @return array
     */
    public function getSubscribedEvents() {
        return array(
            Events::prePersist,
            Events::preUpdate
        );
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $eventArgs) {
        /** @var BaseEntity $entity */
        $entity = $eventArgs->getEntity();
        if ($entity instanceof BaseEntity) {
            $entity->setCreatedAt(new \DateTime('now', new \DateTimeZone('UTC')));
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function preUpdate(LifecycleEventArgs $eventArgs) {
        /** @var BaseEntity $entity */
        $entity = $eventArgs->getEntity();
        if ($entity instanceof BaseEntity) {
            $entity->setUpdatedAt(new \DateTime('now', new \DateTimeZone('UTC')));
        }
    }
}
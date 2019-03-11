<?php

namespace AppBundle\Form;

use AppBundle\Entity\BaseEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BaseRestFormType
 * @package AppBundle\Form
 */
abstract class BaseRestFormType extends AbstractType {

    /** @var string */
    protected $entityName;

    /**
     * @param FormEvent $event
     * @throws \Exception
     */
    public function onSubmit(FormEvent $event) {
        $entity = $event->getData();
        if ($entity instanceof BaseEntity) {
            if (is_null($entity->getCreatedAt()) && is_null($entity->getId())) {
                $entity->setCreatedAt(new \DateTime('now', new \DateTimeZone('UTC')));
            } else {
                $entity->setUpdatedAt(new \DateTime('now', new \DateTimeZone('UTC')));
            }
            $event->setData($entity);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class'        => $this->entityName,
            'csrf_protection'   => false
        ));
    }
}
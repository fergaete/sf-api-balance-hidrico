<?php

namespace AppBundle\Form;

use AppBundle\Entity\EventoHidrico;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

/**
 * Class EventoHidricoType
 * @package AppBundle\Form
 */
class EventoHidricoType extends BaseRestFormType {

    /** @var string */
    protected $entityName = EventoHidrico::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('tipoEvento')
            ->add('cantidad')
            ->add('fecha', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:m:s'
            ))
            ->add('observaciones')
            ->addEventListener(FormEvents::SUBMIT, array($this, 'onSubmit'));
    }

    /**
     * @return string
     */
    public function getBlockPrefix() {
        return 'evento_hidrico';
    }
}

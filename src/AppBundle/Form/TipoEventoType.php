<?php

namespace AppBundle\Form;

use AppBundle\Entity\TipoEvento;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

/**
 * Class TipoEventoType
 * @package AppBundle\Form
 */
class TipoEventoType extends BaseRestFormType {

    /** @var string */
    protected $entityName = TipoEvento::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre')
            ->addEventListener(FormEvents::SUBMIT, array($this, 'onSubmit'));
    }

    /**
     * @return string
     */
    public function getBlockPrefix() {
        return 'tipo_evento';
    }
}

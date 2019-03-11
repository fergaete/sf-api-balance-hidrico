<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Collection\TipoEventoCollection;
use AppBundle\Entity\TipoEvento;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TipoEventoFixtures
 * @package AppBundle\DataFixtures
 */
class TipoEventoFixtures extends Fixture {

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        foreach(TipoEventoCollection::getTipos() as $tipo) {
            $tipoEvento = TipoEvento::create($tipo);
            $manager->persist($tipoEvento);
        }
        $manager->flush();
    }
}
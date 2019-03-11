<?php

namespace AppBundle\Entity\Collection;

use AppBundle\Entity\TipoEvento;

/**
 * Class TipoEventoCollection
 * @package AppBundle\Entity\Collection
 */
class TipoEventoCollection extends BaseCollection {

    /**
     * @var array
     */
    private static $tipos = array(
        TipoEvento::AGUA    => 'Agua',
        TipoEvento::ORINA   => 'Orina',
        TipoEvento::BEBIDA  => 'Bebida',
        TipoEvento::JUGO    => 'Jugo',
        TipoEvento::BATIDO  => 'Batido',
        TipoEvento::LECHE   => 'Leche',
        TipoEvento::TE      => 'Té',
        TipoEvento::CAFE    => 'Café',
        TipoEvento::YOGHURT => 'Yoghurt'
    );

    /**
     * Get tipos
     * @return array
     */
    public static function getTipos() {
        return self::$tipos;
    }
}
<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Collection\EventoHidricoCollection;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class TipoEvento
 * @package AppBundle\Entity
 */
class TipoEvento extends BaseEntity {

    const AGUA      = 1;
    const ORINA     = 2;
    const BEBIDA    = 3;
    const JUGO      = 4;
    const BATIDO    = 5;
    const LECHE     = 6;
    const TE        = 7;
    const CAFE      = 8;
    const YOGHURT   = 9;

    /**
     * @var string
     * @SWG\Property(type="string", maxLength=255, description="Nombre del tipo de evento.")
     */
    private $nombre;

    /**
     * @var EventoHidricoCollection
     * @SWG\Items(type="array", ref=@Model(type=EventoHidrico::class), description="Colección de eventos hidricos.")
     */
    private $eventoHidricos;

    /**
     * @var boolean
     * @SWG\Property(type="string", maxLength=255, description="Si es salida.")
     */
    private $salida = false;

    /**
     * TipoEvento constructor.
     */
    public function __construct() {
        $this->eventoHidricos = new EventoHidricoCollection();
    }

    /**
     * Create
     * @param string $nombre
     * @return TipoEvento
     */
    public static function create($nombre) {
        $instance = new self();
        $instance->setNombre($nombre);
        return $instance;
    }

    /**
     * Get nombre
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set nombre
     * @param string $nombre
     * @return TipoEvento
     */
    public function setNombre($nombre) {
        $this->nombre = (string) $nombre;
        return $this;
    }

    /**
     * Get eventoHidricos
     * @return EventoHidricoCollection
     */
    public function getEventoHidricos() {
        return $this->eventoHidricos;
    }

    /**
     * Add eventoHidrico
     * @param EventoHidrico $eventoHidrico
     * @return void
     */
    public function addEventoHidrico(EventoHidrico $eventoHidrico) {
        $eventoHidrico->setTipoEvento($this);
        $this->eventoHidricos->add($eventoHidrico);
    }

    /**
     * Set eventoHidricos
     * @param EventoHidricoCollection $eventoHidricos
     * @return TipoEvento
     */
    public function setEventoHidricos(EventoHidricoCollection $eventoHidricos) {
        foreach ($eventoHidricos as $eventoHidrico) {
            $this->addEventoHidrico($eventoHidrico);
        }
        return $this;
    }

    /**
     * Get salida
     * @return bool
     */
    public function isSalida() {
        return $this->salida;
    }

    /**
     * Set salida
     * @param bool $salida
     * @return TipoEvento
     */
    public function setSalida($salida) {
        $this->salida = (boolean) $salida;
        return $this;
    }
}
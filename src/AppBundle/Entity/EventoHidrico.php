<?php

namespace AppBundle\Entity;

use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class EventoHidrico
 * @package AppBundle\Entity
 */
class EventoHidrico extends BaseEntity {

    /**
     * @var int
     * @SWG\Property(type="integer", description="Cantidad registrada.")
     */
    private $cantidad;

    /**
     * @var string
     * @SWG\Property(type="string", description="Observaciones u/o comentarios.")
     */
    private $observaciones;

    /**
     * @var TipoEvento
     * @SWG\Property(ref=@Model(type=TipoEvento::class), description="Tipo de evento.")
     */
    private $tipoEvento;

    /**
     * @var \DateTime
     * @SWG\Property(type="string", format="date-time", description="Fecha del evento hídrico.")
     */
    private $fecha;

    /**
     * Get cantidad
     * @return int
     */
    public function getCantidad() {
        return $this->cantidad;
    }

    /**
     * Set cantidad
     * @param int $cantidad
     * @return EventoHidrico
     */
    public function setCantidad($cantidad) {
        $this->cantidad = (int) $cantidad;
        return $this;
    }

    /**
     * Get observaciones
     * @return string
     */
    public function getObservaciones() {
        return $this->observaciones;
    }

    /**
     * Set observaciones
     * @param string $observaciones
     * @return EventoHidrico
     */
    public function setObservaciones($observaciones) {
        $this->observaciones = (string) $observaciones;
        return $this;
    }

    /**
     * Get tipoEvento
     * @return TipoEvento
     */
    public function getTipoEvento() {
        return $this->tipoEvento;
    }

    /**
     * Set tipoEvento
     * @param TipoEvento $tipoEvento
     * @return EventoHidrico
     */
    public function setTipoEvento(TipoEvento $tipoEvento) {
        $this->tipoEvento = $tipoEvento;
        return $this;
    }

    /**
     * Get fecha
     * @return \DateTime
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set fecha
     * @param \DateTime $fecha
     * @return EventoHidrico
     */
    public function setFecha(\DateTime $fecha) {
        $this->fecha = $fecha;
        return $this;
    }
}
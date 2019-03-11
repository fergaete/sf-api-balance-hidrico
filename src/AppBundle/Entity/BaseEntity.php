<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;

/**
 * Class BaseEntity
 * @package AppBundle\Entity
 * @Serializer\ExclusionPolicy("all")
 */
abstract class BaseEntity implements IdentityInterface {

    /**
     * @var int|null
     * @Serializer\Expose
     * @SWG\Property(type="integer", description="El identificador único de la entidad.")
     */
    protected $id;

    /**
     * @var \DateTime
     * @SWG\Property(type="string", format="date-time", description="Fecha de creación.")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @SWG\Property(type="string", format="date-time", description="Fecha de actualización.")
     */
    protected $updatedAt;

    /**
     * @var boolean
     * @SWG\Property(type="boolean", description="Registro eliminado.")
     */
    protected $deleted = false;

    /**
     * @return int|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set createdAt
     * @param \DateTime $createdAt
     * @return BaseEntity
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     * @param \DateTime $updatedAt
     * @return BaseEntity
     */
    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get deleted
     * @return bool
     */
    public function isDeleted() {
        return $this->deleted;
    }

    /**
     * Set deleted
     * @param bool $deleted
     * @return BaseEntity
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }
}
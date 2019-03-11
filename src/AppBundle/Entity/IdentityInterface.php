<?php

namespace AppBundle\Entity;

/**
 * Interface IdentityInterface
 * @package AppBundle\Entity
 */
interface IdentityInterface {

    /**
     * @return int|null
     */
    public function getId();

    /**
     * Get deleted
     * @return bool
     */
    public function isDeleted();

    /**
     * Set deleted
     * @param bool $deleted
     * @return BaseEntity
     */
    public function setDeleted($deleted);
}
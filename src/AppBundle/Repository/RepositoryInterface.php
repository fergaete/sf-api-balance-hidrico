<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Collection\BaseCollection;

/**
 * Interface RepositoryInterface
 * @package AppBundle\Repository\Doctrine
 */
interface RepositoryInterface {

    /**
     * @param array $orderBy
     * @param null $limit
     * @param null $offset
     * @return BaseCollection
     */
    public function findAll(array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param int $id
     * @return object|null
     */
    public function findOneById($id);

    /**
     * @return BaseCollection
     */
    public function findAllNotDelted();

    /**
     * @param int $id
     * @return object|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndNotDeleted($id);
}
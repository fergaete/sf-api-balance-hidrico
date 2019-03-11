<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Collection\BaseCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class BaseRepository
 * @package AppBundle\Repository\Doctrine
 */
abstract class BaseRepository extends EntityRepository implements RepositoryInterface {

    /** @var string */
    protected $aliasQuery;

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilderNotDeleted() {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select($this->getAliasQuery())
            ->from($this->getEntityName(), $this->getAliasQuery())
            ->where($this->getAliasQuery() . '.deleted = FALSE OR ' . $this->getAliasQuery() . '.deleted IS NULL');
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function findOneById($id) {
        $entity = $this->getEntityManager()->getRepository($this->getEntityName())->find((int) $id);
        if($entity) {
            return $entity;
        }
        return null;
    }

    /**
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return BaseCollection|array
     */
    public function findAll(array $orderBy = null, $limit = null, $offset = null) {
        return $this->getEntityManager()->getRepository($this->getEntityName())->findBy(array(), $orderBy, $limit, $offset);
    }

    /**
     * @return BaseCollection
     */
    public function findAllNotDelted() {
        return $this->createQueryBuilderNotDeleted()
            ->orderBy($this->getAliasQuery() . '.id', 'ASC')
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $id
     * @return object|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndNotDeleted($id) {
        return $this->createQueryBuilderNotDeleted()
            ->andWhere($this->getAliasQuery() . '.id = :id')
            ->setParameter('id', (int) $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return string
     */
    public function getAliasQuery() {
        return $this->aliasQuery;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCountSingleScalarResult() {
        return $this->getEntityManager()
            ->getRepository($this->getEntityName())
            ->createQueryBuilder($this->getAliasQuery())
            ->select('count(' . $this->getAliasQuery() . '.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
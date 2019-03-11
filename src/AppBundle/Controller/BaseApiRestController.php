<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BaseEntity;
use AppBundle\Entity\IdentityInterface;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseApiRestController
 * @package AppBundle\Controller
 */
abstract class BaseApiRestController extends AbstractFOSRestController {

    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected $formName;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * BaseApiRestController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $message
     * @return \AppBundle\Entity\Collection\BaseCollection|array|View
     */
    protected function findAllByMesage($message) {
        $results = $this->getDoctrine()->getRepository($this->repositoryName)->findAllNotDelted();
        if ($results === null) {
            return new View($message, Response::HTTP_OK);
        }
        return $results;
    }

    /**
     * @param int $id
     * @param string $message
     * @return Response
     */
    protected function findOneByIdAndMessage($id, $message) {
        $result = $this->getDoctrine()->getRepository($this->repositoryName)->findOneByIdAndNotDeleted($id);
        if ($result === null) {
            return $this->handleView(
                $this->view($message, Response::HTTP_NOT_FOUND)
            );
        }
        return $this->handleView(
            $this->view($result, Response::HTTP_OK)
        );
    }

    /**
     * @param Request $request
     * @param object $entity
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function createByRequestAndEntity(Request $request, $entity) {
        $form = $this->createForm($this->formName, $entity);
        $form->submit($request->request->all());
        if (false === $form->isValid()) {
            return $this->handleView(
                $this->view($form, Response::HTTP_BAD_REQUEST)
            );
        }
        $this->getEntityManager()->persist($form->getData());
        $this->getEntityManager()->flush();
        return $this->handleView(
            $this->view($form->getData(), Response::HTTP_CREATED)
        );
    }

    /**
     * @param Request $request
     * @param int $id
     * @param string $message
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function updateByRequestAndIdAndMessage(Request $request, $id, $message) {
        return $this->createByRequestAndEntity(
            $request,
            $this->isRegistroByIdAndMessage($id, $message)
        );
    }

    /**
     * @param int $id
     * @param string $message
     * @return Response
     */
    protected function isRegistroByIdAndMessage($id, $message) {
        $registro = $this->getDoctrine()->getRepository($this->repositoryName)->findOneByIdAndNotDeleted((int) $id);
        if ($registro === null) {
            return $this->handleView(
                $this->view((string) $message, Response::HTTP_NOT_FOUND)
            );
        }
        return $registro;
    }

    /**
     * @param int $id
     * @param string $messageOk
     * @param string $messageError
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function deleteEtityByIdAndMessageOkAndMessageError($id, $messageOk, $messageError) {
        /** @var BaseEntity $entity */
        $entity = $this->isRegistroByIdAndMessage($id, $messageError);
        if ($entity instanceof IdentityInterface) {
            $entity->setDeleted(true);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }
        return $this->handleView(
            $this->view($messageOk, Response::HTTP_OK)
        );
    }

    /**
     * @return \Doctrine\ORM\EntityManager|object
     */
    protected function getEntityManager() {
        return $this->entityManager;
    }
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventoHidrico;
use AppBundle\Form\EventoHidricoType;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventoHidricoApiController
 * @package AppBundle\Controller
 */
class EventoHidricoApiController extends BaseApiRestController {

    /**
     * @var string
     */
    protected $repositoryName = EventoHidrico::class;

    /**
     * @var string
     */
    protected $formName = EventoHidricoType::class;

    /**
     * @Rest\Get("/api/evento-hidrico")
     * @SWG\Response(
     *     response=200,
     *     description="Devolución de colección de eventos hídricos.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=EventoHidrico::class))
     *     )
     * )
     * @SWG\Tag(name="evento-hidrico")
     * @return \AppBundle\Entity\Collection\BaseCollection|array|View
     */
    public function cgetAction() {
        return parent::findAllByMesage("No existen tipos de eventos.");
    }

    /**
     * @Rest\Get("/api/evento-hidrico/{id}", requirements={"id"="\d+"})
     * @SWG\Response(
     *     response=200,
     *     description="Devolución de un evento hídrico.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=EventoHidrico::class)
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="No existe el evento hídrico."
     * )
     * @SWG\Tag(name="evento-hidrico")
     * @param int $id
     * @return Response
     */
    public function getAction($id) {
        return parent::findOneByIdAndMessage($id, "No existe el evento hídrico.");
    }

    /**
     * @Rest\Post("/api/evento-hidrico")
     * @SWG\Parameter(
     *     name="evento_hidrico",
     *     in="body",
     *     description="Parametros de creación de un evento hídrico.",
     *     @Model(type=EventoHidricoType::class)
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Crear un evento hídrico.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=EventoHidrico::class)
     *     )
     * )
     * @SWG\Response(
     *     response=400,
     *     description="No se pudo crear el evento hídrico."
     * )
     * @SWG\Tag(name="evento-hidrico")
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postAction(Request $request) {
        return parent::createByRequestAndEntity($request, new EventoHidrico());
    }

    /**
     * @Rest\Put("/api/evento-hidrico/{id}", requirements={"id"="\d+"})
     * @SWG\Parameter(
     *     name="evento_hidrico",
     *     in="body",
     *     description="Parametros de modificación de un evento hídrico.",
     *     @Model(type=EventoHidricoType::class)
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Modificar el evento hídrico.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=EventoHidrico::class)
     *     )
     * )
     * @SWG\Response(
     *     response=400,
     *     description="No se pudo modificar el evento hídrico."
     * )
     * @SWG\Tag(name="evento-hidrico")
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function putAction(Request $request, $id) {
        return parent::updateByRequestAndIdAndMessage($request, $id, "No existe el evento hídrico.");
    }

    /**
     * @Rest\Delete("/api/evento-hidrico/{id}", requirements={"id"="\d+"})
     * @SWG\Response(
     *     response=200,
     *     description="Evento hídrico eliminado."
     * )
     * @SWG\Response(
     *     response=404,
     *     description="No existe el evento hídrico."
     * )
     * @SWG\Tag(name="evento-hidrico")
     * @param int $id
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction($id) {
        return parent::deleteEtityByIdAndMessageOkAndMessageError(
            $id,
            "Evento hídrico eliminado.",
            "No existe el evento hídrico."
        );
    }
}
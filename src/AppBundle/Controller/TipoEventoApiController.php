<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoEvento;
use AppBundle\Form\TipoEventoType;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TipoEventoApiController
 * @package AppBundle\Controller
 */
class TipoEventoApiController extends BaseApiRestController {

    /**
     * @var string
     */
    protected $repositoryName = TipoEvento::class;

    /**
     * @var string
     */
    protected $formName = TipoEventoType::class;

    /**
     * @Rest\Get("/api/tipo-eventos")
     * @SWG\Response(
     *     response=200,
     *     description="Devolución de colección de tipo de eventos.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=TipoEvento::class))
     *     )
     * )
     * @SWG\Tag(name="tipo-eventos")
     * @return \AppBundle\Entity\Collection\BaseCollection|array|View
     */
    public function cgetAction() {
        return parent::findAllByMesage("No existen tipos de eventos.");
    }

    /**
     * @Rest\Get("/api/tipo-eventos/{id}", requirements={"id"="\d+"})
     * @SWG\Response(
     *     response=200,
     *     description="Devolución de un tipo de evento.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=TipoEvento::class)
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="No existe el tipo de evento."
     * )
     * @SWG\Tag(name="tipo-eventos")
     * @param int $id
     * @return Response
     */
    public function getAction($id) {
        return parent::findOneByIdAndMessage($id, "No existe el tipo de evento.");
    }

    /**
     * @Rest\Post("/api/tipo-eventos")
     * @SWG\Parameter(
     *     name="tipo_evento",
     *     in="body",
     *     description="Parametros de creación de un tipo de evento.",
     *     @Model(type=TipoEventoType::class)
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Crear un tipo de evento.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=TipoEvento::class)
     *     )
     * )
     * @SWG\Response(
     *     response=400,
     *     description="No se pudo crear el tipo de evento."
     * )
     * @SWG\Tag(name="tipo-eventos")
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postAction(Request $request) {
        return parent::createByRequestAndEntity($request, new TipoEvento());
    }

    /**
     * @Rest\Put("/api/tipo-eventos/{id}", requirements={"id"="\d+"})
     * @SWG\Parameter(
     *     name="tipo_evento",
     *     in="body",
     *     description="Parametros de modificación de un tipo de evento.",
     *     @Model(type=TipoEventoType::class)
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Modificar el tipo de evento.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=TipoEvento::class)
     *     )
     * )
     * @SWG\Response(
     *     response=400,
     *     description="No se pudo modificar el tipo de evento."
     * )
     * @SWG\Tag(name="tipo-eventos")
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function putAction(Request $request, $id) {
        return parent::updateByRequestAndIdAndMessage($request, $id, "No existe el tipo de evento.");
    }

    /**
     * @Rest\Delete("/api/tipo-eventos/{id}", requirements={"id"="\d+"})
     * @SWG\Response(
     *     response=200,
     *     description="Tipo de evento eliminado."
     * )
     * @SWG\Response(
     *     response=404,
     *     description="No existe tipo de evento."
     * )
     * @SWG\Tag(name="tipo-eventos")
     * @param int $id
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction($id) {
        return parent::deleteEtityByIdAndMessageOkAndMessageError(
            $id,
            "Tipo de evento eliminado.",
            "No existe tipo de evento."
        );
    }
}
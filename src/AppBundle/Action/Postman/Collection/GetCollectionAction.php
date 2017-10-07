<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 19:38
 */

namespace AppBundle\Action\Postman\Collection;

use AppBundle\Action\Postman\PostmanConstructorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetCollectionAction
{
    use PostmanConstructorTrait;

    /**
     * @Route("/postman/collections.{_format}", name="api_collections_get_collection")
     * @Method({"GET"})
     *
     * Using annotations is not mandatory, XML and YAML configuration files can be used instead.
     * If you want to decouple your actions from the framework, don't use annotations.
     */
    public function __invoke(Request $request)
    {
        $response = $this->postmanHttpClient->getCollections();

        return new Response(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }
}
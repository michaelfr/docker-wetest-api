<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 19:38
 */

namespace AppBundle\Action;

use AppBundle\Entity\User;
use AppBundle\Postman\PostmanHttpClientConstructorTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserPostmanCollectionList
{
    use PostmanHttpClientConstructorTrait;

    /**
     * @Route(
     *     path="/api/users/{id}/postman/collections.{_format}",
     *     name="api_users_postman_collections_get_collection",
     *     defaults={
     *          "_api_resource_class"=User::class,
     *          "_api_item_operation_name"="user_postman_collection_list",
     *          "_format"="json"
     *     }
     * )
     * @Method({"GET"})
     *
     * Using annotations is not mandatory, XML and YAML configuration files can be used instead.
     * If you want to decouple your actions from the framework, don't use annotations.
     *
     * @param Request $request
     * @param User    $user
     *
     * @return Response
     */
    public function __invoke(Request $request, User $user)
    {
        $response = $this->postmanHttpClient->getCollections($user);

        return new Response(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }
}
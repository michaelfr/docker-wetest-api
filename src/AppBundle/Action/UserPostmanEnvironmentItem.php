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

/**
 * Class UserPostmanEnvironmentItem
 * @package AppBundle\Action
 */
class UserPostmanEnvironmentItem
{
    use PostmanHttpClientConstructorTrait;

    /**
     * @Route(
     *     path="/api/users/{id}/postman/environments/{environmentId}.{_format}",
     *     name="api_users_postman_environments_get_item",
     *     defaults={
     *          "_api_resource_class"=User::class,
     *          "_api_item_operation_name"="user_postman_environment_item",
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
     * @param string  $environmentId
     *
     * @return Response
     */
    public function __invoke(Request $request, User $user, string $environmentId)
    {
        $response = $this->postmanHttpClient->getEnvironments($user, $environmentId);

        return new Response(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }
}
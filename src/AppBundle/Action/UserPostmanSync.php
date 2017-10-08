<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 11:26
 */

namespace AppBundle\Action;

use AppBundle\Entity\User;
use AppBundle\Postman\Synchronizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPostmanSync
{
    /**
     * @var Synchronizer $synchronizer
     */
    protected $synchronizer;

    /**
     * UserPostmanSync constructor.
     *
     * @param Synchronizer $synchronizer
     */
    public function __construct(Synchronizer $synchronizer)
    {
        $this->synchronizer = $synchronizer;
    }

    /**
     * @Route(
     *     path="/api/users/{id}/postman/sync.{_format}",
     *     name="api_users_postman_sync",
     *     defaults={
     *          "_api_resource_class"=User::class,
     *          "_api_item_operation_name"="user_postman_sync",
     *          "_format"="application/json",
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
        $response = $this->synchronizer->sync($user);

        return new Response(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }
}
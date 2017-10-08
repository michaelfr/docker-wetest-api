<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 21:47
 */

namespace AppBundle\Postman;

use AppBundle\Entity\Postman\Collection as EntityCollection;
use AppBundle\Entity\Postman\Environment as EntityEnvironment;
use AppBundle\Entity\User;
use AppBundle\Postman\Model\Collection as ModelCollection;
use AppBundle\Postman\Model\Environment as ModelEnvironment;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class ApiManager
 * @package AppBundle\Postman
 */
class Manager
{
    /**
     * @var Client $client
     */
    protected $client;

    /**
     * @var JsonEncoder
     */
    protected $jsonEncoder;

    /**
     * ApiFacade constructor.
     *
     * @param Client      $client
     * @param JsonEncoder $jsonEncoder
     */
    public function __construct(Client $client, JsonEncoder $jsonEncoder)
    {
        $this->client = $client;
        $this->jsonEncoder = $jsonEncoder;
    }

    /**
     * @param string $uri
     * @param User   $user
     *
     * @return mixed
     */
    private function doRequest(string $uri, User $user)
    {
        $token = $user->getPostmanToken();

        if (null === $token) {
            throw new BadCredentialsException();
        }

        $options = [
            RequestOptions::HEADERS => [
                'X-Api-Key' => $token,
            ],
        ];

        $response = $this->client->get($uri, $options);

        return $this->jsonEncoder->decode(
            $response->getBody()->getContents(),
            JsonEncoder::FORMAT
        );
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function getCollections(User $user): array
    {
        return $this->doRequest("/collections", $user)['collections'] ?? [];
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function getEnvironments(User $user): array
    {
        return $this->doRequest("/environments", $user)['environments'] ?? [];
    }

    /**
     * @param User   $user
     * @param string $id
     *
     * @return array
     */
    public function getCollection(User $user, string $id): array
    {
        return $this->doRequest("/collections/$id", $user)['collection'] ?? [];
    }

    /**
     * @param User   $user
     * @param string $id
     *
     * @return array
     */
    public function getEnvironment(User $user, string $id): array
    {
        return $this->doRequest("/environments/$id", $user)['environment'] ?? [];
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 21:47
 */

namespace AppBundle\Postman;

use AppBundle\Entity\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

/**
 * Class PostmanHttpClient
 * @package AppBundle\Postman
 */
class PostmanHttpClient
{
    /**
     * @var Client $client
     */
    protected $client;

    /**
     * PostmanHttpClient constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param User        $user
     * @param string|null $id
     *
     * @return ResponseInterface
     */
    public function getCollections(User $user, string $id = null)
    {
        return $this->doRequest(null === $id ? "/collections" : "/collections/$id", $user);
    }

    /**
     * @param string $uri
     * @param User   $user
     *
     * @return ResponseInterface
     */
    private function doRequest(string $uri, User $user): ResponseInterface
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

        return $this->client->get($uri, $options);
    }

    /**
     * @param User        $user
     * @param string|null $id
     *
     * @return ResponseInterface
     */
    public function getEnvironments(User $user, string $id = null)
    {
        return $this->doRequest(null === $id ? "/environments" : "/environments/$id", $user);
    }
}
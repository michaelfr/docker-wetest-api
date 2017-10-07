<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 21:47
 */

namespace AppBundle\Postman;

use GuzzleHttp\Client;

class PostmanHttpClient
{
    /**
     * @var Client
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCollections()
    {
        return $this->client->get("/collections");
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCollection($id)
    {
        return $this->client->get("/collections/$id");
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getEnvironments()
    {
        return $this->client->get("/environments");
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getEnvironment($id)
    {
        return $this->client->get("/environments/$id");
    }
}
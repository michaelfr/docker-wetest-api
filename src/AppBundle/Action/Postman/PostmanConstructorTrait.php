<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 21:59
 */

namespace AppBundle\Action\Postman;

trait PostmanConstructorTrait
{
    /**
     * @var \AppBundle\Postman\PostmanHttpClient $postmanHttpClient
     */
    protected $postmanHttpClient;

    /**
     * GetCollectionAction constructor.
     *
     * @param \AppBundle\Postman\PostmanHttpClient $postmanHttpClient
     */
    public function __construct(\AppBundle\Postman\PostmanHttpClient $postmanHttpClient)
    {
        $this->postmanHttpClient = $postmanHttpClient;
    }

}
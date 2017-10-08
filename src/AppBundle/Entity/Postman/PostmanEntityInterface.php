<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 23:26
 */

namespace AppBundle\Entity\Postman;

/**
 * Interface PostmanEntityInterface
 * @package AppBundle\Entity\Postman
 */
interface PostmanEntityInterface
{
    /**
     * @return string
     */
    public function getPostmanId(): string;

    /**
     * @param string $potmanId
     *
     * @return static
     */
    public function setPostmanId(string $potmanId);
}
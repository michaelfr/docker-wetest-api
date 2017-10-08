<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 22:22
 */

namespace AppBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidGenerator
 * @package AppBundle\Doctrine
 */
class UuidGenerator extends AbstractIdGenerator
{
    /**
     * @param EntityManager                $em
     * @param \Doctrine\ORM\Mapping\Entity $entity
     *
     * @return string
     */
    public function generate(EntityManager $em, $entity)
    {
        return Uuid::uuid1()->toString();
    }

}
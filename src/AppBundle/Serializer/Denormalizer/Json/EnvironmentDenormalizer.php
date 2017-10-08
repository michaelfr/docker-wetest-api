<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 14:31
 */

namespace AppBundle\Serializer\Denormalizer\Json;

use AppBundle\Entity\Postman\Collection;
use AppBundle\Entity\Postman\Environment;
use AppBundle\Entity\Postman\Item;
use AppBundle\Entity\User;
use AppBundle\Postman\Manager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class EnvironmentDenormalizer
 * @package AppBundle\Serializer\Denormalizer\Json
 */
class EnvironmentDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    /**
     * @param mixed  $data
     * @param string $class
     * @param null   $format
     * @param array  $context
     *
     * @return Environment
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $entity = (new Environment())
            ->setPostmanId($data['id'])
            ->setName($data['name'])
            ->setUser($context[User::class]);

        return $entity;
    }

    /**
     * @param mixed  $data
     * @param string $type
     * @param null   $format
     *
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return Environment::class === $type
            && JsonEncoder::FORMAT === $format;
    }

}
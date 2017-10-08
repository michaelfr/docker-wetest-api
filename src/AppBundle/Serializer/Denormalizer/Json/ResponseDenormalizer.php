<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 17:22
 */

namespace AppBundle\Serializer\Denormalizer\Json;

use AppBundle\Entity\Postman\Event;
use AppBundle\Entity\Postman\Item;
use AppBundle\Entity\Postman\Request;
use AppBundle\Entity\Postman\Response;
use AppBundle\Entity\Postman\Script;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ResponseDenormalizer
 * @package AppBundle\Serializer\Denormalizer\Json
 */
class ResponseDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    /**
     * @param mixed  $data
     * @param string $class
     * @param null   $format
     * @param array  $context
     *
     * @return Event
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $entity = new Response();

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
        return Response::class === $type
            && JsonEncoder::FORMAT === $format;
    }
}
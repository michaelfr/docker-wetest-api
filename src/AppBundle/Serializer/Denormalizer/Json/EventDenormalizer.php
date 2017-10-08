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
 * Class EventDenormalizer
 * @package AppBundle\Serializer\Denormalizer\Json
 */
class EventDenormalizer implements DenormalizerInterface
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
        $script = null;
        if (isset($data['script'])) {
            /** @var Script $script */
            $script = $this->denormalizer->denormalize($data['script'], Script::class, $format, $context);
        }

        $entity = (new Event())
            ->setListen($data['listen'])
            ->setScript($script);

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
        return Event::class === $type
            && JsonEncoder::FORMAT === $format;
    }
}
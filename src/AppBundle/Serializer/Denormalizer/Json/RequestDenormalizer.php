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
use function GuzzleHttp\Psr7\parse_query;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class RequestDenormalizer
 * @package AppBundle\Serializer\Denormalizer\Json
 */
class RequestDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    /**
     * @param mixed  $data
     * @param string $class
     * @param null   $format
     * @param array  $context
     *
     * @return Request
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $headers = [];
        if (!empty($data['header'])) {
            foreach ($data['header'] as $header) {
                $headers[$header['key']] = $header['value'];
            }
        }

        $entity = (new Request())
            ->setUrl($data['url']['raw'] ?? null)
            ->setMethod($data['method'] ?? null)
            ->setMode($data['body']['mode'] ?? null)
            ->setBody($data['body']['raw'] ?? null)
            ->setHeaders($headers)
            ->setDescription($data['description'] ?? null);

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
        return Request::class === $type
            && JsonEncoder::FORMAT === $format;
    }
}
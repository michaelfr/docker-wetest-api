<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 15/10/17
 * Time: 14:55
 */

namespace AppBundle\Serializer\Denormalizer\Swagger;

use AppBundle\Entity\Definition;
use AppBundle\Interfaces\DocumentationInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DefinitionDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new Definition())
            ->setName($data['name'])
            ->setSchema(\GuzzleHttp\json_encode($data['schema']));
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Definition::class === $type && DocumentationInterface::SWAGGER_FORMAT === $format;
    }

}
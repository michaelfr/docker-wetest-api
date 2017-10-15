<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 21:47
 */

namespace AppBundle\Serializer\Denormalizer;

use AppBundle\Model\Raml;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class RamlDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new Raml())
            ->setTitle($data['title'] ?? null)
            ->setVersion($data['version'] ?? null)
            ->setBaseUri($data['baseUri'] ?? null)
            ->setAnnotationTypes($data['annotationTypes'] ?? [])
            ->setTypes($data['types'] ?? [])
            ->setPaths(array_pop($data) ?? []);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Raml::class === $type;
    }

}
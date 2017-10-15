<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 21:47
 */

namespace AppBundle\Serializer\Denormalizer;

use AppBundle\Model\Raml;
use AppBundle\Model\Swagger;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class SwaggerDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new Swagger())
            ->setSwagger($data['swagger'] ?? null)
            ->setBasePath($data['basePath'] ?? null)
            ->setTitle($data['info']['title'] ?? null)
            ->setVersion($data['info']['version'] ?? null)
            ->setPaths($data['paths'] ?? [])
            ->setDefinitions($data['definitions'] ?? []);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Swagger::class === $type;
    }

}
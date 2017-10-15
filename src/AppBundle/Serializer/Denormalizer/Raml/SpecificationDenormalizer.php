<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 15/10/17
 * Time: 14:55
 */

namespace AppBundle\Serializer\Denormalizer\Raml;

use AppBundle\Entity\Definition;
use AppBundle\Entity\Resource;
use AppBundle\Entity\Specification;
use AppBundle\Interfaces\DocumentationInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class SpecificationDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $definitions = [];
        foreach ($data['types'] as $key => $type) {
            $definitions[] = $this->denormalizer->denormalize(
                $type,
                Definition::class,
                $format,
                ['definition_key' => $key]
            );
        }

        $resources = [];
        foreach (array_pop($data) as $key => $resource) {
            $resources[] = $this->denormalizer->denormalize(
                $resource,
                Resource::class,
                $format,
                $data['annotationTypes'] + ['resource_key' => $key]
            );
        }

        return (new Specification())
            ->setTitle($data['title'])
            ->setVersion($data['version'])
            ->setBaseUri($data['baseUri'])
            ->setResources($resources)
            ->setDefinitions($definitions);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Specification::class === $type && DocumentationInterface::RAML_FORMAT === $format;
    }

}
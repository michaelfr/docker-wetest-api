<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 15/10/17
 * Time: 14:54
 */

namespace AppBundle\Serializer\Denormalizer\Swagger;

use AppBundle\Entity\Definition;
use AppBundle\Entity\Operation;
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
        foreach ($data['definitions'] as $name => $type) {
            $definitions[] = $this->denormalizer->denormalize(
                ['name' => $name, 'schema' => $type],
                Definition::class,
                $format,
                $context
            );
        }

        $operations = [];
        foreach ($data['paths'] as $path => $items) {
            foreach ($items as $method => $value) {
                $operations[] = $this->denormalizer->denormalize(
                    $value + ['method' => $method, 'path' => $path],
                    Operation::class,
                    $format,
                    $context
                );
            }
        }

        $specification = (new Specification())
            ->setTitle($data['info']['title'])
            ->setVersion($data['info']['version'])
            ->setBaseUri($data['basePath'])
            ->setOperations($operations)
            ->setDefinitions($definitions);

        /** @var Definition $definition */
        foreach ($definitions as $definition) {
            $definition->setSpecification($specification);
        }

        /** @var Operation $operation */
        foreach ($operations as $operation) {
            foreach ($operation->getResponses() as $response) {
                $response->setOperation($operation);
            }
            $operation->setSpecification($specification);
        }

        return $specification;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Specification::class === $type && DocumentationInterface::SWAGGER_FORMAT === $format;
    }

}
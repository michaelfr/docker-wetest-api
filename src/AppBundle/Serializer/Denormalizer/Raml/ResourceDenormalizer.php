<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 15/10/17
 * Time: 14:55
 */

namespace AppBundle\Serializer\Denormalizer\Raml;

use AppBundle\Entity\Definition;
use AppBundle\Entity\Operation;
use AppBundle\Entity\Resource;
use AppBundle\Interfaces\DocumentationInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResourceDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $operations = [];
//        foreach ($data as $key => $operation) {
//            $operations[] = $this->denormalizer->denormalize($operation, Operation::class, $format);
//        }

        return (new Resource())
            ->setName($context['resource_key'])
            ->setOperations($operations);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Resource::class === $type && DocumentationInterface::RAML_FORMAT === $format;
    }

}
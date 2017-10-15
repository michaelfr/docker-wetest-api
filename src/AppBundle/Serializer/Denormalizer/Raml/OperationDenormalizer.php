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
use AppBundle\Entity\Response;
use AppBundle\Interfaces\DocumentationInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class OperationDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $responses = [];
        foreach ($data as $key => $response) {
            $responses[] = $this->denormalizer->denormalize($response, Response::class, $format);
        }

        return (new Operation())
            ->setName($context['resource_key'])
            ->setDescription($data['(oas-summary)'])
            ->setParameters($data['queryParameters'])
            ->setResponses($responses);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Operation::class === $type && DocumentationInterface::RAML_FORMAT === $format;
    }

}
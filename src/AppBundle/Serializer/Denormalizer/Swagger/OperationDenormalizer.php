<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 15/10/17
 * Time: 14:55
 */

namespace AppBundle\Serializer\Denormalizer\Swagger;

use AppBundle\Entity\Operation;
use AppBundle\Entity\Response;
use AppBundle\Interfaces\DocumentationInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class OperationDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $type = (false === strpos($data['path'], '{'))
            ? DocumentationInterface::COLLECTION_OPERATION
            : DocumentationInterface::ITEM_OPERATION;

        $responses = [];
        foreach ($data['responses'] as $code => $response) {
            $responses[] = $this->denormalizer->denormalize(
                $response + ['code' => $code],
                Response::class,
                $format,
                $context
            );
        }

        return (new Operation())
            ->setType($type)
            ->setName($data['operationId'])
            ->setMethod($data['method'])
            ->setProduceFormats($data['produces'] ?? [])
            ->setConsumeFormats($data['consumes'] ?? [])
            ->setDescription($data['summary'])
            ->setParameters($data['parameters'])
            ->setUri($data['path'])
            ->setResourceName(current($data['tags']))
            ->setResponses($responses);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return Operation::class === $type && DocumentationInterface::SWAGGER_FORMAT === $format;
    }

}
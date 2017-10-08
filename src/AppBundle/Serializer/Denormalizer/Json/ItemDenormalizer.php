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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ItemDenormalizer
 * @package AppBundle\Serializer\Denormalizer\Json
 */
class ItemDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    /**
     * @param mixed  $data
     * @param string $class
     * @param null   $format
     * @param array  $context
     *
     * @return Item
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $events = [];
        if (isset($data['event'])) {
            foreach ($data['event'] as $event) {
                $events[] = $this->denormalizer->denormalize($event, Event::class, $format, $context);
            }
        }

        $request = null;
        if (isset($data['request'])) {
            /** @var Request $request */
            $request = $this->denormalizer->denormalize($data['request'], Request::class, $format, $context);
        }

        $responses = [];
        if (isset($data['response'])) {
            foreach ($data['response'] as $event) {
                $responses[] = $this->denormalizer->denormalize($event, Response::class, $format, $context);
            }
        }

        $entity = (new Item())
            ->setPostmanId($data['_postman_id'])
            ->setName($data['name'])
            ->setGroup($context['_postman_item_group'] ?? null)
            ->setEvents($events)
            ->setRequest($request)
            ->setResponses($responses);

        /** @var Event $event */
        foreach ($events as $event) {
            $event->setItem($entity);
        }

        if (null !== $request) {
            $request->setItem($entity);
        }

        /** @var Response $event */
        foreach ($responses as $response) {
            $response->setItem($entity);
        }

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
        return Item::class === $type
            && JsonEncoder::FORMAT === $format;
    }
}
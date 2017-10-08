<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 14:31
 */

namespace AppBundle\Serializer\Denormalizer\Json;

use AppBundle\Entity\Postman\Collection;
use AppBundle\Entity\Postman\Item;
use AppBundle\Entity\Postman\PostmanEntityInterface;
use AppBundle\Entity\User;
use AppBundle\Postman\Manager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CollectionDenormalizer
 * @package AppBundle\Serializer\Denormalizer\Json
 */
class CollectionDenormalizer implements DenormalizerInterface
{
    use DenormalizerAwareTrait;

    /**
     * @param mixed  $data
     * @param string $class
     * @param null   $format
     * @param array  $context
     *
     * @return Collection
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $items = [];
        foreach ($data['item'] as $item) {
            // check if is folder
            if (isset($data['name'])
                && isset($data['description'])
                && isset($data['item'])
            ) {
                $context['_postman_item_group'] = $data['name'];
                foreach ($data['item'] as $subItem) {
                    $items[] = $this->denormalizer->denormalize($subItem, Item::class, $format, $context);
                }
            }
            $items[] = $this->denormalizer->denormalize($item, Item::class, $format, $context);
        }

        $entity = (new Collection())
            ->setUser($context[User::class])
            ->setName($data['info']['name'])
            ->setPostmanId($data['info']['_postman_id'])
            ->setDescription($data['info']['description'])
            ->setSchemaUrl($data['info']['schema'])
            ->setItems($items);

        /** @var Item $item */
        foreach ($items as $item) {
            $item->setCollection($entity);
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
        return Collection::class === $type
            && JsonEncoder::FORMAT === $format;
    }

}
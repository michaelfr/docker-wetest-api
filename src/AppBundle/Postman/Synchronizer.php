<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 11:27
 */

namespace AppBundle\Postman;

use AppBundle\Entity\Postman\Collection;
use AppBundle\Entity\Postman\Environment;
use AppBundle\Entity\Postman\PostmanEntityInterface;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use GuzzleHttp\Psr7\Response;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response as sfResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class CollectionSynchronizer
 * @package AppBundle\Postman
 */
class Synchronizer
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var RegistryInterface
     */
    protected $registry;

    /**
     * @var DenormalizerInterface
     */
    protected $serializer;

    /**
     * Synchronizer constructor.
     *
     * @param Manager               $manager
     * @param DenormalizerInterface $serializer
     * @param RegistryInterface     $registry
     */
    public function __construct(
        Manager $manager,
        DenormalizerInterface $serializer,
        RegistryInterface $registry
    ) {
        $this->manager = $manager;
        $this->serializer = $serializer;
        $this->registry = $registry;
    }

    /**
     * @param User $user
     *
     * @return Response
     */
    public function sync(User $user)
    {
        $results = [
            'collections'  => $this->syncCollections($user),
            'environments' => $this->syncEnvironments($user),
        ];

        return new Response(sfResponse::HTTP_MULTI_STATUS, [], \GuzzleHttp\json_encode($results));
    }

    /**
     * @param User $user
     *
     * @return array
     */
    private function syncCollections(User $user): array
    {
        $results = [
            'succeed' => 0,
            'failed'  => 0,
            'errors'  => [],
        ];

        foreach ($this->manager->getCollections($user) as $collection) {
            $data = $this->manager->getCollection($user, $collection['id']);
            $context[User::class] = $user;
            /** @var PostmanEntityInterface $collection */
            $collection = $this->serializer->denormalize(
                $data,
                Collection::class,
                JsonEncoder::FORMAT, $context
            );

            try {
                $this->save($collection);
                $results['succeed']++;
            } catch (\Exception $e) {
                $results['errors'][] = sprintf('%s: %s.', $collection->getPostmanId(), $e->getMessage());
                $results['failed']++;
            }
        }

        return $results;
    }

    /**
     * @param PostmanEntityInterface $entity
     */
    private function save(PostmanEntityInterface $entity)
    {
        $repository = $this->registry->getRepository(get_class($entity));
        $found = $repository->findOneBy(['postmanId' => $entity->getPostmanId()]);

        /** @var ObjectManager $em */
        $em = $this->registry->getManager();

        if (is_a($found, PostmanEntityInterface::class)) {
            $em->merge($entity);
        } else {
            $em->persist($entity);
        }

        $em->flush();
    }

    /**
     * @param User $user
     *
     * @return array
     */
    private function syncEnvironments(User $user): array
    {
        die('toto');
        $results = [
            'succeed' => 0,
            'failed'  => 0,
            'errors'  => [],
        ];

        foreach ($this->manager->getEnvironments($user) as $environment) {
            $data = $this->manager->getEnvironment($user, $environment['id']);
            $context[User::class] = $user;
            /** @var PostmanEntityInterface $environment */
            $environment = $this->serializer->denormalize(
                $data,
                Environment::class,
                JsonEncoder::FORMAT, $context
            );
            try {
                $this->save($environment);
                $results['succeed']++;
            } catch (\Exception $e) {
                $results['errors'][] = sprintf('%s: %s.', $environment->getPostmanId(), $e->getMessage());
                $results['failed']++;
            }
        }

        return $results;
    }

}
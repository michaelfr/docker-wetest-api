<?php

/*
 * This file is part of the PostmanGeneratorBundle package.
 *
 * (c) Vincent Chalamon <vincentchalamon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity\Postman;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"item", "item-read"}},
 *          "denormalization_context"={"groups"={"item", "item-write"}}
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={
 *          @Orm\UniqueConstraint(
 *              name="postman_id_unique",
 *              columns={"postman_id"}
 *          )
 *     }
 * )
 *
 * @UniqueEntity("postmanId")
 */
class Item
{
    /**
     * @var string The entity Id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Doctrine\UuidGenerator")
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Groups({"item-write"})
     */
    protected $postmanId;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"item"})
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"item"})
     */
    protected $group;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"item"})
     */
    protected $description = null;

    /**
     * @var Collection
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Postman\Collection",
     *     inversedBy="items"
     * )
     * @ORM\JoinColumn(name="collection_id", referencedColumnName="id")
     * @Groups({"item-write"})
     */
    protected $collection;

    /**
     * @var Event[]|DoctrineCollection|ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Postman\Event",
     *     mappedBy="item",
     *     cascade={"persist", "remove"}
     * )
     * @Groups({"item-read"})
     */
    protected $events;

    /**
     * @var Request|null
     * @ORM\Column(name="request_id", nullable=true)
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\Postman\Request",
     *     mappedBy="item"
     * )
     * @Groups({"item-read"})
     */
    protected $request;

    /**
     * @var Response[]|DoctrineCollection|ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Postman\Response",
     *     mappedBy="item",
     *     cascade={"persist", "remove"}
     * )
     * @Groups({"item-read"})
     */
    protected $responses;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->responses = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Item
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostmanId(): string
    {
        return $this->postmanId;
    }

    /**
     * @param string $postmanId
     *
     * @return Item
     */
    public function setPostmanId(string $postmanId)
    {
        $this->postmanId = $postmanId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Item
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param null|string $group
     *
     * @return Item
     */
    public function setGroup(string $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     *
     * @return Item
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     *
     * @return Item
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return Event[]|ArrayCollection|DoctrineCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param Event[]|ArrayCollection|DoctrineCollection $events
     *
     * @return Item
     */
    public function setEvents($events)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request|null $request
     *
     * @return Item
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return Response[]|ArrayCollection|DoctrineCollection
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param Response[]|ArrayCollection|DoctrineCollection $responses
     *
     * @return Item
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;

        return $this;
    }
}

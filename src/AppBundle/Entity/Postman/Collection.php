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
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Collection
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"collection", "collection-read"}},
 *          "denormalization_context"={"groups"={"collection", "collection-write"}}
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
class Collection implements PostmanEntityInterface
{
    /**
     * @var string The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Doctrine\UuidGenerator")
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Groups({"collection-write"})
     */
    protected $postmanId;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"collection"})
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"collection"})
     */
    protected $description = null;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"collection"})
     */
    protected $schemaUrl = '';

    /**
     * @var Item[]|DoctrineCollection|ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Postman\Item",
     *     mappedBy="collection",
     *     cascade={"persist", "remove"}
     * )
     * @Groups({"collection-read"})
     */
    protected $items;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="collections")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Groups({"collection-write"})
     */
    protected $user;

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
     * @return Collection
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
     * @return Collection
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
     * @return Collection
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return Collection
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getSchemaUrl(): string
    {
        return $this->schemaUrl;
    }

    /**
     * @param string $schemaUrl
     *
     * @return Collection
     */
    public function setSchemaUrl(string $schemaUrl)
    {
        $this->schemaUrl = $schemaUrl;

        return $this;
    }

    /**
     * @return Item[]|ArrayCollection|DoctrineCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item[]|ArrayCollection|DoctrineCollection $items
     *
     * @return Collection
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Collection
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}

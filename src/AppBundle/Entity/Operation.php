<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 23:17
 */

namespace AppBundle\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Operation
 * @package AppBundle\Entity\Operation
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"operation"}},
 *          "denormalization_context"={"groups"={"operation"}}
 *     }
 * )
 *
 * @ORM\Entity()
 */
class Operation
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
     * @var Resource
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Resource", inversedBy="operations")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * @Groups({"operation"})
     */
    protected $resource;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Choice({"item", "collection"})
     * @Groups({"operation"})
     */
    protected $type;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"operation"})
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"operation"})
     */
    protected $method;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"operation"})
     */
    protected $uri;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"operation"})
     */
    protected $description = null;

    /**
     * @var array
     * @ORM\Column(type="array", length=255)
     * @Groups({"operation"})
     */
    protected $consumeFormats = [];

    /**
     * @var array
     * @ORM\Column(type="array", length=255)
     * @Groups({"operation"})
     */
    protected $produceFormats = [];

    /**
     * @var array
     * @ORM\Column(type="array", length=255)
     * @Groups({"operation"})
     */
    protected $parameters = [];

    /**
     * @var Response[]|DoctrineCollection|ArrayCollection|array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Response", mappedBy="operation")
     * @Groups({"operation"})
     */
    protected $responses;
}
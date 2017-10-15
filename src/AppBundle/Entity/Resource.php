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
 * Class Resource
 * @package AppBundle\Entity\Resource
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"resource"}},
 *          "denormalization_context"={"groups"={"resource"}}
 *     }
 * )
 *
 * @ORM\Entity()
 */
class Resource
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
     * @var Specification
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Specification", inversedBy="resources")
     * @ORM\JoinColumn(name="specification_id", referencedColumnName="id")
     * @Groups({"resource"})
     */
    protected $specification;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"resource"})
     */
    protected $name;

    /**
     * @var Operation[]|DoctrineCollection|ArrayCollection|array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Operation", mappedBy="resource")
     * @Groups({"resource-read"})
     */
    protected $operations;

    /**
     * Resource constructor.
     */
    public function __construct()
    {
        $this->operations = new ArrayCollection();
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
     * @return Resource
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Specification
     */
    public function getSpecification(): Specification
    {
        return $this->specification;
    }

    /**
     * @param Specification $specification
     *
     * @return Resource
     */
    public function setSpecification(Specification $specification)
    {
        $this->specification = $specification;

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
     * @return Resource
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Operation[]|array|ArrayCollection|DoctrineCollection
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param Operation[]|array|ArrayCollection|DoctrineCollection $operations
     *
     * @return Resource
     */
    public function setOperations($operations)
    {
        $this->operations = $operations;

        return $this;
    }
}
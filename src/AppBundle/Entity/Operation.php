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
     * @var Specification
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Specification", inversedBy="operations")
     * @ORM\JoinColumn(name="specification_id", referencedColumnName="id")
     * @Groups({"operation"})
     */
    protected $specification;

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
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"operation"})
     */
    protected $resourceName;

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
     * @return Operation
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Operation
     */
    public function setType(string $type)
    {
        $this->type = $type;

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
     * @return Operation
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return Operation
     */
    public function setMethod(string $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     *
     * @return Operation
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return $this->resourceName;
    }

    /**
     * @param string $resourceName
     *
     * @return Operation
     */
    public function setResourceName(string $resourceName)
    {
        $this->resourceName = $resourceName;

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
     * @return Operation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return array
     */
    public function getConsumeFormats(): array
    {
        return $this->consumeFormats;
    }

    /**
     * @param array $consumeFormats
     *
     * @return Operation
     */
    public function setConsumeFormats(array $consumeFormats)
    {
        $this->consumeFormats = $consumeFormats;

        return $this;
    }

    /**
     * @return array
     */
    public function getProduceFormats(): array
    {
        return $this->produceFormats;
    }

    /**
     * @param array $produceFormats
     *
     * @return Operation
     */
    public function setProduceFormats(array $produceFormats)
    {
        $this->produceFormats = $produceFormats;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     *
     * @return Operation
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return Response[]|array|ArrayCollection|DoctrineCollection
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param Response[]|array|ArrayCollection|DoctrineCollection $responses
     *
     * @return Operation
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;

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
     * @return Operation
     */
    public function setSpecification(Specification $specification)
    {
        $this->specification = $specification;

        return $this;
    }
}
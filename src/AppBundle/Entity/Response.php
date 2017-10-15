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
 * Class Response
 * @package AppBundle\Entity\Response
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"response"}},
 *          "denormalization_context"={"groups"={"response"}}
 *     }
 * )
 *
 * @ORM\Entity()
 */
class Response
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
     * @var Operation
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Operation", inversedBy="responses")
     * @ORM\JoinColumn(name="operation_id", referencedColumnName="id")
     * @Groups({"response"})
     */
    protected $operation;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Groups({"response"})
     */
    protected $statusCode;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"response"})
     */
    protected $description = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"response"})
     */
    protected $schema = null;

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
     * @return Response
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Operation
     */
    public function getOperation(): Operation
    {
        return $this->operation;
    }

    /**
     * @param Operation $operation
     *
     * @return Response
     */
    public function setOperation(Operation $operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return Response
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

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
     * @return Response
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param null|string $schema
     *
     * @return Response
     */
    public function setSchema(string $schema = null)
    {
        $this->schema = $schema;

        return $this;
    }

}
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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Definition
 * @package AppBundle\Entity\Definition
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"definition"}},
 *          "denormalization_context"={"groups"={"definition"}}
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="specification_name_unique", columns={"specification_id", "name"})
 *     }
 * )
 *
 * @UniqueEntity(
 *     fields={"specification", "name"},
 *     errorPath="name",
 *     message="The name is already use in this specification."
 * )
 */
class Definition
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Specification", inversedBy="definitions")
     * @ORM\JoinColumn(name="specification_id", referencedColumnName="id")
     * @Groups({"definition"})
     */
    protected $specification;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"definition"})
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Groups({"definition"})
     */
    protected $schema;

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
     * @return Definition
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
     * @return Definition
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
     * @return Definition
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSchema(): string
    {
        return $this->schema;
    }

    /**
     * @param string $schema
     *
     * @return Definition
     */
    public function setSchema(string $schema)
    {
        $this->schema = $schema;

        return $this;
    }
}
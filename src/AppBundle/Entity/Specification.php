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
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Specification
 * @package AppBundle\Entity\Specification
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"specification"}},
 *          "denormalization_context"={"groups"={"specification"}}
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="project_title_version_unique", columns={"project_id", "title", "version"})
 *     }
 * )
 *
 * @UniqueEntity(
 *     fields={"project", "title", "version"},
 *     errorPath="title",
 *     message="The title/version must be unique by project."
 * )
 */
class Specification
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"specification"})
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"specification"})
     */
    protected $version;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"specification"})
     */
    protected $baseUri;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project", inversedBy="specifications")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * @Groups({"specification"})
     */
    protected $project;

    /**
     * @var Resource[]|DoctrineCollection|ArrayCollection|array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Resource", mappedBy="specification")
     * @Groups({"specification"})
     */
    protected $resources;

    /**
     * @var Definition[]|DoctrineCollection|ArrayCollection|array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Definition", mappedBy="specification")
     * @Groups({"specification"})
     */
    protected $definitions;

    /**
     * Specification constructor.
     */
    public function __construct()
    {
        $this->resources = new ArrayCollection();
        $this->definitions = new ArrayCollection();
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
     * @return Specification
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Specification
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Specification
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     *
     * @return Specification
     */
    public function setBaseUri(string $baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     *
     * @return Specification
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return array|ArrayCollection|DoctrineCollection|Resource[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param array|ArrayCollection|DoctrineCollection|Resource[] $resources
     *
     * @return Specification
     */
    public function setResources($resources)
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * @return Definition[]|array|ArrayCollection|DoctrineCollection
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * @param Definition[]|array|ArrayCollection|DoctrineCollection $definitions
     *
     * @return Specification
     */
    public function setDefinitions($definitions)
    {
        $this->definitions = $definitions;

        return $this;
    }
}
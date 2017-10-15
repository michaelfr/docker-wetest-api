<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 22:23
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
 * Class Project
 * @package AppBundle\Entity\Project
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"project"}},
 *          "denormalization_context"={"groups"={"project"}}
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="user_title_unique", columns={"user_id", "title"})
 *     }
 * )
 *
 * @UniqueEntity(
 *     fields={"user", "title"},
 *     errorPath="title",
 *     message="This title is already in use."
 * )
 */
class Project
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
     * @Groups({"project"})
     */
    protected $title;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"project"})
     */
    protected $description = null;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Groups({"project"})
     */
    protected $user;

    /**
     * @var Specification[]|DoctrineCollection|ArrayCollection|array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Specification", mappedBy="project")
     * @Groups({"project"})
     */
    protected $specifications;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->specifications = new ArrayCollection();
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
     * @return Project
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
     * @return Project
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

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
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * @return Project
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Specification[]|array|ArrayCollection|DoctrineCollection
     */
    public function getSpecifications()
    {
        return $this->specifications;
    }

    /**
     * @param Specification[]|array|ArrayCollection|DoctrineCollection $specifications
     *
     * @return Project
     */
    public function setSpecifications($specifications)
    {
        $this->specifications = $specifications;

        return $this;
    }
}
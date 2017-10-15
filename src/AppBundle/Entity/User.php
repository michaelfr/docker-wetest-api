<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 22:17
 */

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection as DoctrineCollection;

/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"user"}},
 *          "denormalization_context"={"groups"={"user"}}
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="email_unique", columns={"email"})
 *     }
 * )
 *
 * @UniqueEntity("email")
 */
class User extends BaseUser
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
     * @Groups({"user"})
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user"})
     */
    protected $fullname;

    /**
     * @Groups({"user"})
     */
    protected $plainPassword;

    /**
     * @Groups({"user"})
     */
    protected $username;

    /**
     * @var Project[]|DoctrineCollection|ArrayCollection|array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Project", mappedBy="user")
     * @Groups({"user"})
     */
    protected $projects;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->projects = new ArrayCollection();
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }
    public function getFullname()
    {
        return $this->fullname;
    }

    public function isUser(UserInterface $user = null)
    {
        return $user instanceof self && $user->id === $this->id;
    }

    /**
     * @return Project[]|DoctrineCollection|ArrayCollection|array
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param Project[]|DoctrineCollection|ArrayCollection|array $projects
     *
     * @return User
     */
    public function setProjects(array $projects = [])
    {
        $this->projects = $projects;

        return $this;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 07/10/17
 * Time: 22:17
 */

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Entity\Postman\Collection;
use AppBundle\Entity\Postman\Environment;
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
 *          "normalization_context"={"groups"={"user", "user-read"}},
 *          "denormalization_context"={"groups"={"user", "user-write"}}
 *     }
 * )
 *
 * @ORM\Entity
 * @ORM\Table(
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="email_postman_token_unique", columns={"email", "postman_token"})
 *     }
 * )
 *
 * @UniqueEntity(
 *     fields={"email", "postmanToken"},
 *     errorPath="postmanToken",
 *     message="This postmanToken is already in use with another email."
 * )
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
     * @Groups({"user-write"})
     */
    protected $plainPassword;

    /**
     * @var string|null $postmanToken
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-write"})
     */
    protected $postmanToken = null;

    /**
     * @Groups({"user"})
     */
    protected $username;

    /**
     * @var Collection[]|DoctrineCollection|ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Postman\Collection", mappedBy="user")
     * @Groups({"user-read"})
     */
    protected $collections;

    /**
     * @var Environment[]|DoctrineCollection|ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Postman\Environment", mappedBy="user")
     * @Groups({"user-read"})
     */
    protected $environments;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->collections = new ArrayCollection();
        $this->environments = new ArrayCollection();
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
     * @return mixed
     */
    public function getPostmanToken()
    {
        return $this->postmanToken;
    }

    /**
     * @param mixed $postmanToken
     *
     * @return User
     */
    public function setPostmanToken($postmanToken)
    {
        $this->postmanToken = $postmanToken;

        return $this;
    }

    /**
     * @return Collection[]|ArrayCollection|DoctrineCollection
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @param Collection[]|ArrayCollection|DoctrineCollection $collections
     *
     * @return User
     */
    public function setCollections($collections)
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * @return Environment[]|ArrayCollection|DoctrineCollection
     */
    public function getEnvironments()
    {
        return $this->environments;
    }

    /**
     * @param Environment[]|ArrayCollection|DoctrineCollection $environments
     *
     * @return User
     */
    public function setEnvironments($environments)
    {
        $this->environments = $environments;

        return $this;
    }
}
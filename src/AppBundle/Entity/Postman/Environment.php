<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 14:22
 */

namespace AppBundle\Entity\Postman;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Environment
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"environment", "environment-read"}},
 *          "denormalization_context"={"groups"={"environment", "environment-write"}}
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
class Environment implements PostmanEntityInterface
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Groups({"environment-write"})
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
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="environments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Groups({"environment-write"})
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
     * @return Environment
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
     * @return Environment
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
     * @return Environment
     */
    public function setName(string $name)
    {
        $this->name = $name;

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
     * @return Environment
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

}